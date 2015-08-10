<?php
$params = array_merge(
    require(__DIR__ . '/../../_common/engine/config/params.php'),
    require(__DIR__ . '/../../_common/engine/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

//todo config goed zetten

//return [
//    'id' => 'app-frontend',
//    'basePath' => dirname(__DIR__),
//    'bootstrap' => ['log'],
//    'controllerNamespace' => 'frontend\controllers',
//    'components' => [
//        'user' => [
//            'identityClass' => 'common\models\User',
//            'enableAutoLogin' => true,
//        ],
//        'log' => [
//            'traceLevel' => YII_DEBUG ? 3 : 0,
//            'targets' => [
//                [
//                    'class' => 'yii\log\FileTarget',
//                    'levels' => ['error', 'warning'],
//                ],
//            ],
//        ],
//        'errorHandler' => [
//            'errorAction' => 'site/error',
//        ],
//    ],
//    'params' => $params,
//];
