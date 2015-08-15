<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $navItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];

    if ( Yii::$app->user->isGuest ) {
        $navItems[] = [
            'label' =>  'Signup',
            'url'   =>  ['/user/registration/register']
        ];
        $navItems[] = [
            'label' =>  'Login',
            'url'   =>  ['/user/security/login']
        ];
    } else {
        $navItems[] = [
            'label' =>  '<i class="glyphicon glyphicon-user"></i> ' . Yii::$app->user->identity->username,
            'url'   =>  ['#'],
            'items' =>  [
                [
                    'label' =>  'Logged in as <b>'.Yii::$app->user->identity->username.'</b>',
                    'url'   =>  ['/user/settings'],
                ],
                '<li role="presentation" class="divider"></li>',
                [
                    'label' =>  'Settings',
                    'url'   =>  ['/user/settings'],
                ],
                '<li role="presentation" class="divider"></li>',
                [
                    'label' =>  'Logout',
                    'url'   =>  ['/user/security/logout'],
                    'linkOptions'   => ['data-method' => 'post']
                ]
            ]
        ];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $navItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
