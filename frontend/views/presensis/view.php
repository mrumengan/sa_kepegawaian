<?php

use common\components\SBHelpers;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Presensi */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Presensi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="presensi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->can('Admin')) : ?>
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
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Karyawan',
                'value' => function ($data) {
                    return $data->karyawan->nama . '<br />NIK: ' . $data->karyawan->nip;
                },
                'format' => 'raw'
            ],
            'latitude',
            'longitude',
            'address',
            [
                'attribute' => 'created_at',
                'value' => function ($data) {
                    return SBHelpers::getTanggalJam($data->created_at);
                }
            ],
        ],
    ]) ?>

</div>