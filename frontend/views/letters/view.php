<?php

use common\components\SBHelpers;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Letters */

$this->title = $model->ref_nomor_surat;
$this->params['breadcrumbs'][] = ['label' => 'Surat Menyurat', 'url' => [$model->type]];
$this->params['breadcrumbs'][] = ['label' => $model->titles[$model->type]];
\yii\web\YiiAsset::register($this);
?>
<div class="letters-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col">
            <p class="text-right">
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-sm btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Download', ['download', 'id' => $model->id], ['class' => 'btn btn-sm btn-secondary']) ?>
            </p>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ref_nomor_surat',
            'ref_asal_surat',
            [
                'attribute' => 'ref_tanggal',
                'value' => function ($data) {
                    return SBHelpers::getTanggal($data->ref_tanggal);
                }
            ],
            'ref_hal:ntext',
            // 'nomor_surat',
            // 'sifat',
            'lampiran',
            'hal:ntext',
        ],
    ]) ?>

</div>