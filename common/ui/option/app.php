<?php
// ©2017 http://your.domain.com All rights reserved.

/**
 * 应用全局配置文件
 *
 * @author Name Your <your@mail.com>
 * @package $$
 * @since 2016.11.19
 * @version 1.0
 */
return [

        /**
         * ---------------------------------------------------------------
         * 运行环境
         * ---------------------------------------------------------------
         *
         * 根据不同的阶段设置不同的开发环境
         * 可以为 production : 生产环境 testing : 测试环境 development : 开发环境
         */
        'app_environment' => env('app_environment', 'development'),

        /**
         * ---------------------------------------------------------------
         * 是否打开调试模式
         * ---------------------------------------------------------------
         *
         * 打开调试模式可以显示更多精确的错误信息
         */
        'app_debug' => env('app_debug', false),

        /**
         * ---------------------------------------------------------------
         * 自定义命名空间 （ 名字 = 入口路径）
         * ---------------------------------------------------------------
         *
         * 你可以在这里设置你应用程序的自定义命名空间
         * 相关文档请访问 [执行流程.MVC\命名空间与自动载入.Namespace.Autoload]
         * see https://github.com/hunzhiwange/document/blob/master/execution-flow/namespace-and-autoload.md
         */
        'namespace' => [ ],

        /**
         * ---------------------------------------------------------------
         * 应用提供者
         * ---------------------------------------------------------------
         *
         * 这里的服务提供者为类的名字，例如 home\is\provider\test
         * 每一个服务提供者必须包含一个 register 方法，还可以包含一个 bootstrap 方法
         * 系统所有 register 方法注册后，bootstrap 才开始执行以便于调用其它服务提供者 register 注册的服务
         * 相关文档请访问 [系统架构\应用服务提供者]
         * see https://github.com/hunzhiwange/document/blob/master/system-architecture/service-provider.md
         */
        'provider' => [
                'queryyetsimple\auth',
                'queryyetsimple\cache',
                'queryyetsimple\cookie',
                'queryyetsimple\database',
                'queryyetsimple\encryption',
                'queryyetsimple\event',
                'queryyetsimple\filesystem',
                'queryyetsimple\http',
                'queryyetsimple\i18n',
                'queryyetsimple\log',
                'queryyetsimple\mail',
                'queryyetsimple\mvc',
                'queryyetsimple\option',
                'queryyetsimple\page',
                'queryyetsimple\pipeline',
                'queryyetsimple\queue',
                'queryyetsimple\router',
                'queryyetsimple\session',
                'queryyetsimple\throttler',
                'queryyetsimple\validate',
                'queryyetsimple\view'
        ],

        /**
         * ---------------------------------------------------------------
         * 中间件分组
         * ---------------------------------------------------------------
         *
         * 分组可以很方便地批量调用组件
         */
        'middleware_group' => [
                'web' => [
                        'session'
                ],

                'api' => [
                        'throttler:60,1'
                ],

                'common' => [
                        'log'
                ]
        ],

        /**
         * ---------------------------------------------------------------
         * 中间件别名
         * ---------------------------------------------------------------
         *
         * HTTP 中间件提供一个方便的机制来过滤进入应用程序的 HTTP 请求
         * 例外在应用执行结束后响应环节也会调用 HTTP 中间件
         */
        'middleware_alias' => [
                'session' => 'queryyetsimple\session\middleware\session',
                'throttler' => 'queryyetsimple\throttler\middleware\throttler',
                'log' => 'queryyetsimple\log\middleware\log'
        ],

        /**
         * ---------------------------------------------------------------
         * 自定义命令
         * ---------------------------------------------------------------
         *
         * 如果你创建了一个命令，你需要在这里注册这个命令
         * 命令一行一条，直接书写完整的命名空间类
         */
        'console' => [ ],

        /**
         * ---------------------------------------------------------------
         * 默认应用
         * ---------------------------------------------------------------
         *
         * 默认应用非常重要，与路由解析息息相关
         */
        'default_app' => 'home',

        /**
         * ---------------------------------------------------------------
         * 默认控制器
         * ---------------------------------------------------------------
         *
         * 未指定的控制器，此时会默认指定为此控制器
         */
        'default_controller' => 'index',

        /**
         * ---------------------------------------------------------------
         * 默认方法
         * ---------------------------------------------------------------
         *
         * 未指定的方法，此时会默认指定为此方法
         */
        'default_action' => 'index',

        /**
         * ---------------------------------------------------------------
         * 默认响应方式
         * ---------------------------------------------------------------
         *
         * default 为默认的解析方式
         * api 接口模式，json、view 和默认返回 api 格式数据
         */
        'default_response' => 'default',

        /**
         * ---------------------------------------------------------------
         * 约定请求方法
         * ---------------------------------------------------------------
         *
         * 系统约束后台请求类型，通过 $_POST['_method'] 判断
         */
        'var_method' => '_method',

        /**
         * ---------------------------------------------------------------
         * 约定 ajax
         * ---------------------------------------------------------------
         *
         * 系统约束后台 ajax，通过$参数['_ajax'] 判断
         * 所有参数不包含文件参数 $_FILES
         */
        'var_ajax' => '_ajax',

        /**
         * ---------------------------------------------------------------
         * 约定 pjax
         * ---------------------------------------------------------------
         *
         * 系统约束后台 pjax，通过$参数['_pjax'] 判断
         * $参数不包含文件参数 $_FILES
         */
        'var_pjax' => '_pjax',

        /**
         * ---------------------------------------------------------------
         * Gzip 压缩
         * ---------------------------------------------------------------
         *
         * 启用页面 gzip 压缩，需要系统支持 gz_handler 函数
         */
        'start_gzip' => true,

        /**
         * ---------------------------------------------------------------
         * 系统时区
         * ---------------------------------------------------------------
         *
         * 此配置用于 date_default_timezone_set 应用设置系统时区
         * 此功能会影响到 date.time 相关功能
         */
        'time_zone' => 'Asia/Shanghai',

        /**
         * ---------------------------------------------------------------
         * 安全 key
         * ---------------------------------------------------------------
         *
         * 请妥善保管此安全 key,防止密码被人破解
         * queryyetsimple\encryption\encryption 安全 key
         */
        'app_auth_key' => env('app_auth_key', '7becb888f518b20224a988906df51e05'),

        /**
         * ---------------------------------------------------------------
         * 安全过期时间
         * ---------------------------------------------------------------
         *
         * 0 表示永不过期
         * queryyetsimple\encryption\encryption 安全过期时间
         */
        'app_auth_expiry' => 0,

        /**
         * ---------------------------------------------------------------
         * 系统所有应用
         * ---------------------------------------------------------------
         *
         * 系统在运行过程中会自动缓存 {项目}/application 下面的目录
         * 这个缓存将会用于注册命名空间以及用于路由解析
         */
        '~apps~' => [ ]
];
