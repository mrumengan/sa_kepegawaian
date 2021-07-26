<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Kgb */

$this->title = 'KGB Baru';
$this->params['breadcrumbs'][] = ['label' => 'KGB', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kgb-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'karyawan' => $karyawan
    ]) ?>

</div>