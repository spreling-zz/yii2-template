<?php
$params = array_merge(
    require(__DIR__ . '/../../../_common/core/config/params.php'),
    require(__DIR__ . '/../../../_common/core/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'spreling-frontend',

    //Paths uses alliases
    'basePath' => '@frontend/core',
    'runtimePath' => '@frontend/runtime',


    //defaultRoute uses request path
    'defaultRoute' => 'zionCore/site/index',
    'bootstrap' => ['log'],



    //modules uses namespace
    'modules' => [
        'zionCore' => [
            'class' => 'frontendModules\zionCore\ZionCoreModule',
        ],
        'account' => 'frontendModules\account\AccountModule',
    ],

    'components' => [
        'user' => [
            'identityClass' => 'commonModules\account\models\AccountLoginLogic',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
//        'errorHandler' => [
//            'errorAction' => 'zionCore/site/error',
//        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => array(
                'index' => '/zionCore/site/',
                'about' => '/zionCore/site/about',
                'contact' => '/zionCore/site/contact',
                'login' => '/account/account/login',
                'logout' => '/account/account/logout',
                'signup' => '/account/account/signup',
                'login/reset' => '/account/account/request-password-reset',
                'login/reset-password/<token:.+>' => '/account/account/reset-password',

                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ],
    ],
    'params' => $params,
];

