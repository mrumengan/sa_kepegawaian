<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Karyawan */

if ($model->status_asn == 10) {
    $status_asn = 'asn';
} else {
    $status_asn = 'non-asn';
}

$this->title = 'Update Karyawan: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Karyawan', 'url' => [$status_asn]];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Perubahan';
?>
<div class="karyawan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'status_asn' => $status_asn
    ]) ?>

</div>