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

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="float-right">
        <?php if (!Yii::$app->user->can('Admin') && $model->status == 1) { ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php }  ?>
        <?php if (Yii::$app->user->can('Admin')) {
            echo Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
        } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'karyawan.nama'
            ],
            'tanggal_cuti:date',
            'jumlah',
            [
                'label' => 'Tipe Cuti',
                'value' => function ($model) {
                    return $model->cutiTipe->description;
                }
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->statuses[$model->status];
                }
            ]
        ],
    ]) ?>
    <p class="float-right">
        <?php if (Yii::$app->user->can('Admin') && $model->status == 5) { ?>
            <?= Html::a('<i class="fas fa-file-pdf"></i> Download PDF', ['download', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php }  ?>
    </p><br />
</div>