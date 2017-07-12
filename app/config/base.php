<?php
return [
    'config' => [
        'properties' => require_once __DIR__ . '/'.APP_ENV.'/properties.php',
    ],
    'application'           => [
        'id'          => SYSTEM_NAME,
        'name'        => SYSTEM_NAME,
        'viewsPath'   => VIEWS_PATH,
        'runtimePath' => RUNTIME_PATH,
        'settingPath' => SETTING_PATH,
        'basePath'    => dirname(__DIR__),
    ],
    'urlManager'            => [
        'rules' => [
            '/home/data'     => '/index',
            '/index/index/1' => '/index/index',
            '/post/<id:\d+>' => 'post/view'
        ],
    ],
    'filter'                => [
        'filters' => [
            'commonParamsFilter' => [
                'class'      => 'app\beans\filters\CommonParamsFilter',
                'uriPattern' => '/*',
            ],
            'loginFilter'        => [
                'class'      => 'app\beans\filters\LoginFilter',
                'uriPattern' => '/index/login',
            ]
        ]
    ],
    'managerPool'           => [
        'services' => [
            "user" => [
                "class"     => \swoft\pool\ServicePool::class,
                "maxIdel"   => 6,
                "maxActive" => 10,
                "timeout"   => '${config.service.user.timeout}',
            ]
        ]
    ],
    "circuitBreakerManager" => [
        'swithToFailCount'    => 10,
        'swithToSuccessCount' => 10,
        'delaySwithTimer'     => 20000,
    ],
    "logger"                => [
        'name'    => SYSTEM_NAME,
        "targets" => [
            [
                "class"   => \swoft\log\FileHandler::class,
                "logFile" => RUNTIME_PATH . "/notice.log",
                "levels"  => [
                    \swoft\log\Logger::NOTICE,
                    \swoft\log\Logger::INFO,
                    \swoft\log\Logger::DEBUG,
                ]
            ],
            [
                "class"   => \swoft\log\FileHandler::class,
                "logFile" => RUNTIME_PATH . "/error.log",
                "levels"  => [
                    \swoft\log\Logger::ERROR,
                    \swoft\log\Logger::WARNING
                ]
            ]
        ]
    ]
];