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

use Common\Domain\Entity\User;
use Leevel\Collection\Collection;
use Leevel\Database\Ddd\IUnitOfWork;
use Leevel\Kernel\HandleException;

/**
 * 批量修改用户状态.
 *
 * @author Name Your <your@mail.com>
 *
 * @since 2017.10.23
 *
 * @version 1.0
 */
class Status
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
        $this->save($this->findAll($input), $input['status']);

        return [];
    }

    /**
     * 保存状态
     *
     * @param \Leevel\Collection\Collection $entitys
     * @param string                        $status
     */
    protected function save(Collection $entitys, string $status)
    {
        foreach ($entitys as $entity) {
            $entity->status = $status;
            $this->w->persist($entity);
        }

        $this->w->flush();
    }

    /**
     * 查询符合条件的用户.
     *
     * @param array $input
     *
     * @return \Leevel\Collection\Collection
     */
    protected function findAll(array $input): Collection
    {
        $entitys = $this->w->repository(User::class)->

        findAll(function ($select) use ($input) {
            $select->whereIn('id', $input['ids']);
        });

        if (0 === count($entitys)) {
            throw new HandleException(__('未发现用户'));
        }

        return $entitys;
    }
}
