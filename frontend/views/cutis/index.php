<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cuti';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuti-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-1">&nbsp;</div>
    </div>

    <p class="float-right">
        <?= Html::a('Buat Cuti', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'value' => function ($data) {
                    $width = 4;
                    $padded = str_pad($data->id, $width, "0", STR_PAD_LEFT);
                    return $padded;
                }
            ],
            'karyawan.nama',
            'tanggal_cuti:date',
            'jumlah:integer',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return $data->statuses[$data->status];
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>