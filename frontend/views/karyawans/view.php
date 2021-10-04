<?php

use common\components\SBHelpers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Karyawan */

$this->registerCssFile('@web/css/karyawans.view.css');

if ($model->status_asn == 10) {
    $status_asn = 'asn';
} else {
    $status_asn = 'non-asn';
}

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Karyawan', 'url' => [$status_asn]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="karyawan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col text-right">
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
        </div>
    </div>

    <div class="row">
        <div class="col-md-9 order-md-1 order-2">
            <?php if ($model->status_asn == 10) {
                $detail_attributes = [
                    'nama',
                    'nip',
                    [
                        'attribute' => 'golongan',
                        'value' => function ($data) {
                            return strtoupper($data->golongan . ' - ' . $data->golRuang->pangkat);
                        }
                    ],
                    'jabatan',
                    // [
                    //     'label' => 'Unit Kerja',
                    //     'value' => function ($model) {
                    //         if ($model->departemen)
                    //             return $model->departemen->nama;
                    //         else
                    //             return null;
                    //     }
                    // ],
                    'tempat_lahir',
                    [
                        'attribute' => 'tanggal_lahir',
                        'value' => function ($data) {
                            return SBHelpers::getTanggal($data->tanggal_lahir);
                        }
                    ],
                    [
                        'attribute' => 'tmt_pangkat',
                        'value' => function ($data) {
                            return SBHelpers::getTanggal($data->tmt_pangkat);
                        }
                    ],
                    [
                        'attribute' => 'tmt_jabatan',
                        'value' => function ($data) {
                            return SBHelpers::getTanggal($data->tmt_jabatan);
                        }
                    ],
                    'eselon',
                    'pangkat_cpns',
                    [
                        'attribute' => 'tmt_cpns',
                        'value' => function ($data) {
                            return SBHelpers::getTanggal($data->tmt_cpns);
                        }
                    ],
                    [
                        'attribute' => 'tmt_pns',
                        'value' => function ($data) {
                            return SBHelpers::getTanggal($data->tmt_pns);
                        }
                    ],
                    'gaji_pokok',
                    [
                        'attribute' => 'tmt_gaji',
                        'value' => function ($data) {
                            return SBHelpers::getTanggal($data->tmt_gaji);
                        }
                    ],
                    'pendidikan',
                    'pendidikan_umum',
                    'diklat_struktural',
                    'diklat_fungsional',
                    'jenis_kelamin',
                    'nip_lama',
                    // 'peringkat',
                    [
                        'label' => 'Status',
                        'value' => function ($model) {
                            return $model->statuses[$model->status_asn];
                        }
                    ],
                    [
                        'label' => 'User ID',
                        'value' => function ($model) {
                            if ($model->user)
                                return $model->user->username;
                            else
                                return null;
                        }
                    ],
                ];
            } else {
                $detail_attributes = [
                    'nama',
                    'nip',
                    'tempat_lahir',
                    [
                        'attribute' => 'tanggal_lahir',
                        'value' => function ($data) {
                            return SBHelpers::getTanggal($data->tanggal_lahir);
                        }
                    ],
                    'gaji_pokok',
                    // [
                    //     'attribute' => 'tmt_gaji',
                    //     'value' => function ($data) {
                    //         return SBHelpers::getTanggal($data->tmt_gaji);
                    //     }
                    // ],
                    'pendidikan',
                    'pendidikan_umum',
                    'jenis_kelamin',
                    [
                        'label' => 'Status',
                        'value' => function ($model) {
                            return $model->statuses[$model->status_asn];
                        }
                    ],
                    [
                        'label' => 'User ID',
                        'value' => function ($model) {
                            if ($model->user)
                                return $model->user->username;
                            else
                                return null;
                        }
                    ],
                ];
            }
            ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => $detail_attributes,
            ]) ?>
        </div>
        <div class="col-md-3 order-md-2 order-1">
            <?php if ($model->foto) { ?>
                <img src="<?= Url::to('@web/media/img/' . $model->foto) ?>" class="img-fluid rounded img-thumbnail" />
            <?php } else { ?>
                <div class="text-center img-thumbnail img-fluid rounded" style="font-size: 10em;"><i class="fas fa-user"></i></div>
            <?php } ?>
        </div>
    </div>

</div>