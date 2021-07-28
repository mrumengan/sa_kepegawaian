<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'KGB';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kgb-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-1">&nbsp;</div>
    </div>

    <div class="row">
        <div class="col">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'nama',
                        'value' => function ($data) {
                            return "<strong>{$data->nama}</strong><div>{$data->nip}</div>";
                        },
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'overflow-x: hidden;'],
                    ],
                    'tmt_gaji',
                    'tmt_pns',
                    'tmt_cpns',
                    [
                        'class' => 'yii\grid\ActionColumn', 'template' => '{view} {create}',
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return Html::a('<i class="fas fa-eye"></i>', ['karyawan', 'id' => $model->id], ['title' => 'lihat detil']);
                            },
                            'create' => function ($url, $model, $key) {
                                return Html::a('<i class="fas fa-plus-circle"></i>', ['create', 'id' => $model->id], ['title' => 'tambah kenaikan']);
                            }
                        ]
                    ],
                ],
            ]); ?>

        </div>
    </div>

</div>