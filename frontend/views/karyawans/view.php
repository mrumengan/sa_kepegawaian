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
<div class="karyawan-view">

    <h1><?= Html::encode($this->title) ?></h1>

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'departemen_id',
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