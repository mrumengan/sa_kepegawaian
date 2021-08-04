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
            <?= Html::a('Buat KGB Baru', ['index-karyawan'], ['title' => 'tambah kenaikan', 'class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label' => 'No. Surat',
                        'value' => function ($data) {
                            $padded = str_pad($data->id, $data->code_width, "0", STR_PAD_LEFT) . '/KGB/' . date('my', strtotime($data->tanggal_kenaikan));
                            return $padded;
                        }
                    ],
                    [
                        'label' => 'Name',
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
                        'label' => 'Surat Pengangkatan',
                        'value' => function ($data) {
                            return $data->signed_pdf;
                        }
                    ],
                    [
                        'label' => 'Status',
                        'value' => function ($data) {
                            return $data->statuses[$data->status] . '<br />' . SBHelpers::getTanggal(date('Y-m-d', $data->created_at));
                        },
                        'format' => 'raw'
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn', 'template' => '{view} {create}',
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return Html::a('<i class="fas fa-eye"></i>', ['view', 'id' => $model->id], ['title' => 'lihat detil']);
                            },
                            // 'create' => function ($url, $model, $key) {
                            //     return Html::a('<i class="fas fa-plus-circle"></i>', ['create', 'id' => $model->id], ['title' => 'tambah kenaikan']);
                            // }
                        ]
                    ],
                ],
            ]); ?>

        </div>
    </div>

</div>