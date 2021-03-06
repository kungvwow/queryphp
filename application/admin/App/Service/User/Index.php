<?php

declare(strict_types=1);

/*
 * This file is part of the forcodepoem package.
 *
 * The PHP Application Created By Code Poem. <Query Yet Simple>
 * (c) 2018-2099 http://forcodepoem.com All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Admin\App\Service\User;

use Closure;
use Common\Domain\Entity\User;
use Leevel\Database\Ddd\IEntity;
use Leevel\Database\Ddd\IUnitOfWork;
use Leevel\Database\Ddd\Select;

/**
 * 用户列表.
 *
 * @author Name Your <your@mail.com>
 *
 * @since 2017.11.23
 *
 * @version 1.0
 */
class Index
{
    /**
     * 事务工作单元.
     *
     * @var \Leevel\Database\Ddd\IUnitOfWork
     */
    protected $w;

    /**
     * 构造函数.
     *
     * @param \Leevel\Database\Ddd\IUnitOfWork $w
     */
    public function __construct(IUnitOfWork $w)
    {
        $this->w = $w;
    }

    /**
     * 响应方法.
     *
     * @param array $input
     *
     * @return array
     */
    public function handle(array $input): array
    {
        $repository = $this->w->repository(User::class);

        list($page, $entitys) = $repository->findPage(
            (int) ($input['page'] ?: 1),
            (int) ($input['size'] ?? 10),
            $this->condition($input)
        );

        $data['page'] = $page;
        $data['data'] = [];

        foreach ($entitys as $item) {
            $tmp = $item->toArray();
            $tmp['role'] = $item->role->toArray();
            $data['data'][] = $tmp;
        }

        return $data;
    }

    /**
     * 查询条件.
     *
     * @param array $input
     *
     * @return \Closure
     */
    protected function condition(array $input): Closure
    {
        return function (Select $select, IEntity $entity) use ($input) {
            $select->eager(['role']);

            if ($input['key']) {
                $select->where(function ($select) use ($input) {
                    $select->orWhere('name', 'like', '%'.$input['key'].'%')->

                        orWhere('identity', 'like', '%'.$input['key'].'%');
                });
            }

            if ($input['status'] || '0' === $input['status']) {
                $select->where('status', $input['status']);
            }

            $select->orderBy('id DESC');
        };
    }
}
