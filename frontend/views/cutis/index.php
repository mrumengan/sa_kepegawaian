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

    <p class="float-right">
        <?= Html::a('Create Cuti', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'value' => function ($data) {
                    $number = 12;
                    $width = 4;
                    $padded = str_pad($data->id, $width, "0", STR_PAD_LEFT);
                    return $padded;
                }
            ],
            'karyawan.nama',
            'tanggal_cuti',
            'jumlah',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>