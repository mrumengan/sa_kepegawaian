<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Letters */

$this->title = $model->ref_nomor_surat;
$this->params['breadcrumbs'][] = ['label' => 'Surat Menyurat'];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="letters-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ref_nomor_surat',
            'ref_asal_surat',
            'ref_tanggal:date',
            'ref_hal:ntext',
            'nomor_surat',
            'sifat',
            'lampiran',
            'hal:ntext',
        ],
    ]) ?>

</div>