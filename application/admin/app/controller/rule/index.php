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

namespace admin\app\controller\rule;

use admin\app\controller\aaction;
use admin\app\service\rule\index as service;

/**
 * 后台权限列表.
 *
 * @author Name Your <your@mail.com>
 *
 * @since 2017.12.11
 *
 * @version 1.0
 * @menu
 * @title 列表
 * @name
 * @path
 * @component
 * @icon
 */
class index extends aaction
{
    /**
     * 响应方法.
     *
     * @param \admin\app\service\rule\index $oService
     *
     * @return mixed
     */
    public function run(service $oService)
    {
        return $oService->run();
    }
}
