<?php

Yii::setAlias('common', dirname(dirname(__DIR__)));
Yii::setAlias('commonModules', dirname(dirname(__DIR__)).'/core/modules');
Yii::setAlias('frontend', dirname(dirname(dirname(__DIR__))) . '/frontend');
Yii::setAlias('frontendModules', dirname(dirname(dirname(__DIR__))) . '/frontend/core/modules');
Yii::setAlias('frontendAssets', dirname(dirname(dirname(__DIR__))) . '/frontend/core/assets');
Yii::setAlias('backend', dirname(dirname(dirname(__DIR__))) . '/backend');
Yii::setAlias('backendModules', dirname(dirname(dirname(__DIR__))) . '/backend/core/modules');
Yii::setAlias('console', dirname(dirname(dirname(__DIR__))) . '/console');
Yii::setAlias('consoleModules', dirname(dirname(dirname(__DIR__))) . '/console/core/modules');
