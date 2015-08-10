<?php
defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'prod');

require(__DIR__ . '/../../_common/vendor/autoload.php');
require(__DIR__ . '/../../_common/vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../_common/engine/config/bootstrap.php');
require(__DIR__ . '/../engine/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../_common/engine/config/main.php'),
    require(__DIR__ . '/../../_common/engine/config/main-local.php'),
    require(__DIR__ . '/../engine/config/main.php'),
    require(__DIR__ . '/../engine/config/main-local.php')
);

$application = new yii\web\Application($config);
$application->run();
