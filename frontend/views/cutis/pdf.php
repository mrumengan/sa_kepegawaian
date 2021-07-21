<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Cuti */

$this->title = str_pad($model->id, $model->code_width, "0", STR_PAD_LEFT);
$this->params['breadcrumbs'][] = ['label' => 'Cuti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cuti-view">

    <div class="row justify-content-end">
        <div class="col-md-4">
            <p>Jakarta, <?= $model->tanggalCuti ?></p>
            <p>
            <div>Kepada</div>
            <div>Yth. Sekretaris Badan Penelitian dan Pengembangan</div>
            <div>Di Jakarta</div>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col text-center">
            <h3>Formulir Permintaan dan Pemberian Cuti</h3>
        </div>
    </div>

</div>