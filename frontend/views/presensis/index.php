<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\SBHelpers;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PresensiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Presensi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presensi-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <p class="text-right">
        <?php
        if (Yii::$app->user->can('HRD')) {
            echo Html::a('Laporan', ['report'], ['class' => 'btn btn-primary btn-sm']);
        }
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Karyawan',
                'value' => function ($data) {
                    return $data->karyawan->nama . '<br />NIK: ' . $data->karyawan->nip;
                },
                'format' => 'raw'
            ],
            'latitude',
            'longitude',
            [
                'attribute' => 'address',
                'value' => function ($data) {
                    return '<strong>' . strtoupper($data->work_from) . '</strong><br />' . $data->address;
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($data) {
                    return SBHelpers::getTanggalJam($data->created_at);
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'update' => function ($model, $key, $index) {
                        return Yii::$app->user->can('Admin');
                    },
                    'delete' => function ($model, $key, $index) {
                        return Yii::$app->user->can('Admin');
                    }
                ]
            ],
        ],
    ]); ?>


</div>