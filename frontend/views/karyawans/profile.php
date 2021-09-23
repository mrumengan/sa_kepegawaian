<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Karyawan */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="karyawan-profile">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col text-right">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-9">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'nama',
                    'nip',
                    [
                        'attribute' => 'golongan',
                        'value' => function ($data) {
                            return strtoupper($data->golongan . ' - ' . $data->golRuang->pangkat);
                        }
                    ],
                    'jabatan',
                    'tempat_lahir',
                    'tanggal_lahir',
                    'golongan',
                    'tmt_pangkat',
                    'tmt_jabatan',
                    'eselon',
                    'pangkat_cpns',
                    'tmt_cpns',
                    'tmt_pns',
                    'gaji_pokok',
                    'tmt_gaji',
                    'pendidikan',
                    'pendidikan_umum',
                    'diklat_struktural',
                    'diklat_fungsional',
                    'jenis_kelamin',
                    'nip_lama',
                    'peringkat',
                    [
                        'attribute' => 'user.username',
                        'label' => 'User'
                    ],
                ],
            ]) ?>
        </div>
        <div class="col-3">
            <?php if ($model->foto) { ?>
                <img src="<?= Url::to('@web/media/photo/' . $model->foto) ?>" class="img-fluid rounded img-thumbnail" />
            <?php } else { ?>
                <div class="text-center img-thumbnail img-fluid rounded" style="font-size: 10em;"><i class="fas fa-user"></i></div>
            <?php } ?>
        </div>
    </div>

</div>