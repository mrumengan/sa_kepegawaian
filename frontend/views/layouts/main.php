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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => '<span style="font-size: 1.2em;"><strong>' . Yii::$app->name . '</strong></span><br /><span style="font-size: .8em;">Sistim Informasi Kepegawaian Ramah dan Cepat</span>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-lg navbar-dark bg-dark',
            ],
            'renderInnerContainer' => false,
            'containerOptions' => ['class' => 'justify-content-end']
        ]);
        $menuItems = [
            ['label' => 'Beranda', 'url' => ['/site/index']],

            ['label' => 'Data Pegawai', 'url' => ['/karyawans'], 'visible' => Yii::$app->user->can('Admin'), 'items' => [
                ['label' => 'ASN', 'url' => ['/karyawans/asn']],
                ['label' => 'Non ASN', 'url' => ['/karyawans/non-asn']],
            ]],
            ['label' => 'Presensi Non ASN', 'url' => ['/presensis'], 'visible' => Yii::$app->user->can('Admin')],
            ['label' => 'Presensi Non ASN', 'url' => ['/presensis'], 'visible' => !Yii::$app->user->isGuest && (Yii::$app->user->asn === 0), 'items' => [
                ['label' => 'WFO', 'url' => ['/presensis/wfo']],
                ['label' => 'WFH', 'url' => ['/presensis/wfh']],
            ]],
            ['label' => 'Cuti', 'url' => ['/cutis'], 'visible' => Yii::$app->user->can('Admin')],
            ['label' => 'KGB', 'url' => ['/kgb/index-karyawan'], 'visible' => Yii::$app->user->can('Admin')],
            // ['label' => 'Penghasilan', 'url' => ['/golongan'], 'visible' => Yii::$app->user->can('Admin')],

            ['label' => 'Cuti', 'url' => ['/cutis/request'], 'visible' => !Yii::$app->user->isGuest && !Yii::$app->user->can('Admin')],
            ['label' => 'Profil', 'url' => ['/karyawans/profile', 'id' => Yii::$app->user->id], 'visible' => !Yii::$app->user->isGuest && !Yii::$app->user->can('Admin')],
            ['label' => 'Surat Menyurat', 'visible' => Yii::$app->user->can('Admin'), 'items' => [
                ['label' => 'Usul Kenaikan Pangkat', 'url' => ['/letters/pangkat']],
                ['label' => 'Usul Mutasi', 'url' => ['/letters/mutasi']],
                ['label' => 'Usul TB / IB', 'url' => ['/letters/belajar']],
                ['label' => 'Usul Satya Lencana', 'url' => ['/letters/satya-lencana']],
                ['label' => 'Usul Pensiun', 'url' => ['/letters/pensiun']],
                ['label' => 'Usul Mutasi', 'url' => ['/letters/mutasi']],
                ['label' => 'Usul Jabfung', 'url' => ['/letters/jabfung']],
                ['label' => 'Usul Pencantuman Gelar', 'url' => ['/letters/gelar']],
                ['label' => 'Usul Cuti Alasan Penting', 'url' => ['/letters/cuti-penting']],
            ]],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
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

        <div class="container">
            <?= Breadcrumbs::widget([
                'homeLink' => [
                    'label' => 'Beranda',
                    'url' => '/',
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
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