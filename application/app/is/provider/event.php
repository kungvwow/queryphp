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

namespace home\infrastructure\provider;

use queryyetsimple\bootstrap\provider\event as provider_event;

class event extends provider_event
{
    protected $arrListener = [
        'common\domain\event\test' => [
            'common\domain\listener\test',
        ],

        'common\domain\event\test2' => [
            'common\domain\listener\test2',
        ],
    ];
}
