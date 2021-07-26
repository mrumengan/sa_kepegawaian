<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Kgb */

$this->title = str_pad($model->id, $model->code_width, "0", STR_PAD_LEFT);
$this->params['breadcrumbs'][] = ['label' => 'KGB', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kgb-view">

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
            [
                'attribute' => 'karyawan.nama'
            ],
            'jumlah:currency',
            'tanggal_kenaikan:date',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->statuses[$model->status];
                }
            ]
        ],
    ]) ?>

</div>