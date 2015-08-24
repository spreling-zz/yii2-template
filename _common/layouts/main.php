<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontendAssets\ZionCoreAsset;
use common\widgets\Alert;

$this->registerMetaTag(['name' => 'keywords', 'content' => 'spreling, software, maatwerk'], 'keywords');
$this->registerMetaTag(['name' => 'description', 'content' => 'A website made by spreling'], 'description');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1'], 'viewport');
ZionCoreAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <!--[if IE]><link rel="shortcut icon" href="<?= Yii::getAlias('@web')."/favicon.ico" ?>"><![endif]-->
    <link rel="icon" href="<?= Yii::getAlias('@web') . "/favicon.png" ?>">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php
NavBar::begin([
    'brandLabel' => 'My Company',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-default navbar-fixed-top',
    ],
    'innerContainerOptions' => [
        'class' => 'container-fluid',
    ],
]);
$menuItems = [
    ['label' => 'Home', 'url' => ['/']],
    ['label' => 'About', 'url' => ['/about']],
    ['label' => 'Contact', 'url' => ['/contact']],
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Signup', 'url' => ['/signup']];
    $menuItems[] = ['label' => 'Login', 'url' => ['/login']];
} else {
    $menuItems[] = [
        'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
        'url' => ['/logout'],
        'linkOptions' => ['data-method' => 'post']
    ];
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
NavBar::end();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 center">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container-fluid">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
    </div>
</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
