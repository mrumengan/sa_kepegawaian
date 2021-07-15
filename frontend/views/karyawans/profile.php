<?php

use yii\helpers\Html;
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

    <p class="float-right">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'user.username',
                'label' => 'User'
            ],
            [
                'attribute' => 'departemen.nama',
                'label' => 'Departemen'
            ],
            'nip',
            'nama',
            'tempat_lahir',
            'tanggal_lahir',
            'golongan',
            'tmt_pangkat',
            'jabatan',
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
        ],
    ]) ?>

</div>