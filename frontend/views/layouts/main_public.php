<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$site_title = Yii::$app->name;
if ($this->title != Yii::$app->name) {
    $site_title = Html::encode($this->title) . ' | ' . Yii::$app->name;
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= $site_title ?></title>
    <?php $this->head() ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => '<span style="font-size: 1.2em;"><strong>' . Yii::$app->name . '</strong></span><br /><span style="font-size: 1.5vw;">Sistem Informasi Kepegawaian Ramah dan Cepat</span>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-lg navbar-light bg-light',
            ],
            'renderInnerContainer' => false,
            'containerOptions' => ['class' => 'justify-content-end']
        ]);
        $menuItems = [
            ['label' => 'Beranda', 'url' => ['/site/index']],

            ['label' => 'Karyawan', 'url' => ['/karyawans'], 'visible' => Yii::$app->user->can('Admin')],
            ['label' => 'Cuti', 'url' => ['/cutis'], 'visible' => Yii::$app->user->can('Admin')],
            ['label' => 'Golongan', 'url' => ['/golongan'], 'visible' => Yii::$app->user->can('Admin')],

            ['label' => 'Cuti', 'url' => ['/cutis/request'], 'visible' => !Yii::$app->user->isGuest && !Yii::$app->user->can('Admin')],
            ['label' => 'Profil', 'url' => ['/karyawans/profile', 'id' => Yii::$app->user->id], 'visible' => !Yii::$app->user->isGuest],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Mendaftar', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Masuk', 'url' => ['/site/login']];
        } else {
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>

        <div class="container-fluid">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div><br />
    </div>

    <footer class="footer">
        <div class="container">
            <p class="">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>