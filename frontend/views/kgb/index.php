<?php
/* @var $this yii\web\View */

use common\models\Kgb;
use yii\helpers\Html;
use yii\grid\GridView;
use common\components\SBHelpers;

$this->title = 'Kenaikan Gaji Berkala';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kgb-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col text-right">
            <!-- <?= Html::a('Buat KGB Baru', ['index-karyawan'], ['title' => 'tambah kenaikan', 'class' => 'btn btn-primary']) ?> -->
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'headerRowOptions' => ['style' => 'text-align: center !important;'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn', 'header' => 'No.',],
                    [
                        'label' => 'Nama',
                        'value' => function ($data) {
                            $link = Html::a($data->karyawan->nama, ['/karyawans/view', 'id' => $data->karyawan->id], $options = []);
                            return "<strong>{$link}</strong><div>{$data->karyawan->nip}</div>";
                        },
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'overflow-x: hidden;'],
                    ],
                    [
                        'attribute' => 'tanggal_kenaikan',
                        'value' => function ($data) {
                            return SBHelpers::getTanggal($data->tanggal_kenaikan);
                        }
                    ],
                    [
                        'label' => 'Gaji Pokok Lama',
                        'value' => function ($data) {
                            return $data->karyawan->gaji_pokok;
                        },
                        // 'format' => 'currency'
                    ],
                    [
                        'label' => 'Gaji Pokok Baru',
                        'value' => function ($data) {
                            return $data->jumlah;
                        },
                        'format' => 'currency'
                    ],
                    [
                        'label' => 'Status',
                        'value' => function ($data) {
                            return $data->statuses[$data->status] . '<br />' . SBHelpers::getTanggal(date('Y-m-d', $data->created_at));
                        },
                        'format' => 'raw'
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn', 'template' => '{view} {deny}',
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return Html::a('<i class="fas fa-eye"></i>', ['view', 'id' => $model->id], ['title' => 'lihat detil']);
                            },
                            'deny' => function ($url, $model, $key) {
                                return Html::a('<i class="far fa-times-circle" style="color: red;"></i>', ['create', 'id' => $model->id], ['title' => 'tolak kenaikan']);
                            }
                        ]
                    ],
                    [
                        'label' => 'Penetapan',
                        'value' => function ($data) {
                            return $data->signed_pdf;
                        }
                    ],
                ],
            ]); ?>

        </div>
    </div>

</div>