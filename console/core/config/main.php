<?php
$params = array_merge(
    require(__DIR__ . '/../../../_common/core/config/params.php'),
    require(__DIR__ . '/../../../_common/core/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'spreling-console',
    'basePath' => '@console/core',
    'runtimePath' => '@console/runtime',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
];
