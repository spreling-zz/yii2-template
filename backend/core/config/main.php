<?php
$params = array_merge(
    require(__DIR__ . '/../../../_common/engine/config/params.php'),
    require(__DIR__ . '/../../../_common/engine/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

//todo config goed zetten

//return [
//    'id' => 'sprelingApp-backend',
//    'basePath' => dirname(__DIR__),
//    'controllerNamespace' => 'backend\controllers',
//    'bootstrap' => ['log'],
//    'modules' => [],
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
