<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Cuti */

$this->title = str_pad($model->id, $model->code_width, "0", STR_PAD_LEFT);
$this->params['breadcrumbs'][] = ['label' => 'Cuti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<page>
    <table class="table-bordered" width="100%">
        <tr>
            <td colspan="8">&nbsp;</td>
            <td colspan="4">
                <p>Jakarta, <?= $model->tanggalCuti ?> Baru</p>
                <div>Kepada</div>
                <div>Yth. Sekretaris Badan Penelitian dan Pengembangan</div>
                <div>Di Jakarta</div>
            </td>
        </tr>
        <tr>
            <td colspan="12" height="60">
                <center>
                    <h3>Formulir Permintaan dan Pemberian Cuti</h3>
                </center>
            </td>
        </tr>
        <tr>
            <td colspan="12">I. DATA PEGAWAI</td>
        </tr>
        <tr>
            <td colspan="3">Nama</td>
            <td colspan="3"><?= $model->karyawan->nama ?></td>
            <td colspan="3">NIP</td>
            <td colspan="3"><?= $model->karyawan->nip ?></td>
        </tr>
        <tr>
            <td colspan="3">Jabatan</td>
            <td colspan="3"><?= $model->karyawan->jabatan ?></td>
            <td colspan="3">Masa Kerja</td>
            <td colspan="3"><?= $model->karyawan->masaKerja ?> tahun</td>
        </tr>
        <tr>
            <td colspan="3">Unit Kerja</td>
            <td colspan="9">Badan Penelitian dan Pengembangan Kemendagri</td>
        </tr>
    </table>
</page>