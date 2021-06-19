<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Golongan */

$this->title = $model->nama_golongan;
$this->params['breadcrumbs'][] = ['label' => 'Golongan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="golongan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col">
            <p class="float-right">
                <?= Html::a('Perbarui', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama_golongan',
            [
                'attribute' => 'gaji_pokok',
                'contentOptions' => ['class' => 'text-right'],
                'format' => 'currency'
            ],
            [
                'attribute' => 'tunjangan_istri',
                'contentOptions' => ['class' => 'text-right'],
                'format' => 'currency'
            ],
            [
                'attribute' => 'tunjangan_anak',
                'contentOptions' => ['class' => 'text-right'],
                'format' => 'currency'
            ],
            [
                'attribute' => 'tunjangan_transport',
                'contentOptions' => ['class' => 'text-right'],
                'format' => 'currency'
            ],
            [
                'attribute' => 'tunjangan_makan',
                'contentOptions' => ['class' => 'text-right'],
                'format' => 'currency'
            ],
        ],
    ]) ?>

</div>