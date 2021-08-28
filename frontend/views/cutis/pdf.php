<?php

use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Cuti */

$this->title = str_pad($model->id, $model->code_width, "0", STR_PAD_LEFT);
$this->params['breadcrumbs'][] = ['label' => 'Cuti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<page>
    <table class="table-bordereds" width="100%">
        <thead>
            <tr>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
            </tr>
        </thead>
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
            <td colspan="12" height="40">
                <center>
                    <h3>Formulir Permintaan dan Pemberian Cuti</h3>
                </center>
            </td>
        </tr>
    </table>

    <table class="table-bordered" width="100%">
        <thead>
            <tr>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
            </tr>
        </thead>
        <tr>
            <td colspan="12">I. DATA PEGAWAI</td>
        </tr>
        <tr>
            <td colspan="2">Nama</td>
            <td colspan="6"><?= $model->karyawan->nama ?></td>
            <td colspan="1">NIP</td>
            <td colspan="3"><?= $model->karyawan->nip ?></td>
        </tr>
        <tr>
            <td colspan="2">Jabatan</td>
            <td colspan="6"><?= $model->karyawan->jabatan ?></td>
            <td colspan="1">Masa Kerja</td>
            <td colspan="3"><?= $model->karyawan->masaKerja ?></td>
        </tr>
        <tr>
            <td colspan="2">Unit Kerja</td>
            <td colspan="10">Badan Penelitian dan Pengembangan Kemendagri</td>
        </tr>
    </table>

    <table class="table-bordered" width="100%">
        <thead>
            <tr>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
            </tr>
        </thead>
        <tr>
            <td colspan="12">II. JENIS CUTI YANG DIAMBIL </td>
        </tr>
        <tr>
            <td colspan="4">1. Cuti Tahunan</td>
            <td colspan="2" class="text-center"><?= $model->cutiTipe->id == 1 ? '<span style="font-size: 1.5em;">√</span>' : '' ?></td>
            <td colspan="4">2. Cuti Besar</td>
            <td colspan="2" class="text-center"><?= $model->cutiTipe->id == 2 ? '<span style="font-size: 1.5em;">√</span>' : '' ?></td>
        </tr>
        <tr>
            <td colspan="4">3. Cuti Sakit</td>
            <td colspan="2" class="text-center"><?= $model->cutiTipe->id == 3 ? '<span style="font-size: 1.5em;">√</span>' : '' ?></td>
            <td colspan="4">4. Cuti Melahirkan</td>
            <td colspan="2" class="text-center"><?= $model->cutiTipe->id == 4 ? '<span style="font-size: 1.5em;">√</span>' : '' ?></td>
        </tr>
        <tr>
            <td colspan="4">5. Cuti Alasan Penting</td>
            <td colspan="8" class="text-center"><?= $model->cutiTipe->id == 5 ? '<span style="font-size: 1.5em;">√</span>' : '' ?></td>
        </tr>
    </table>

    <table class="table-bordered" width="100%">
        <thead>
            <tr>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
            </tr>
        </thead>
        <tr>
            <td colspan="12">III. ALASAN CUTI</td>
        </tr>
        <tr>
            <td colspan="12"><?= $model->description ?></td>
        </tr>
    </table>

    <table class="table-bordered" width="100%">
        <thead>
            <tr>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
            </tr>
        </thead>
        <tr>
            <td colspan="12">IV. LAMANYA CUTI</td>
        </tr>
        <tr>
            <td colspan="2">Selama <?= $model->jumlah ?></td>
            <td colspan="2">(hari/<s>bulan</s>/<s>tahun</s>)</td>
            <td colspan="2">Mulai Tanggal</td>
            <td colspan="2"><?= date('d/m/Y', strtotime($model->tanggal_cuti)) ?></td>
            <td colspan="2">s/d</td>
            <?php
            $tanggal_cuti = date_create($model->tanggal_cuti);
            date_add($tanggal_cuti, date_interval_create_from_date_string($model->jumlah . ' days'));
            ?>
            <td colspan="2"><?= date_format($tanggal_cuti, 'd/m/Y') ?></td>
        </tr>
    </table>


    <table class="table-bordered" width="100%">
        <thead>
            <tr>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
            </tr>
        </thead>
        <tr>
            <td colspan="12">V. CATATAN CUTI</td>
        </tr>
        <tr>
            <td colspan="6">1. Cuti Tahunan</td>
            <td colspan="4">2. Cuti Besar</td>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">Tahun</td>
            <td colspan="2">Sisa</td>
            <td colspan="2">Keterangan</td>
            <td colspan="4">3. Cuti Sakit</td>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">N-1</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="4">4. Cuti Melahirkan</td>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">N-2</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="4">5. Cuti Alasan Penting</td>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">N</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="4">6. Cuti Diluar Tangungan Negara</td>
            <td colspan="2">&nbsp;</td>
        </tr>
    </table>

    <table class="table-bordered" width="100%">
        <thead>
            <tr>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
            </tr>
        </thead>
        <tr>
            <td colspan="12">VI. ALAMAT SELAMA MENJALANKAN CUTI</td>
        </tr>
        <tr>
            <td rowspan="2" colspan="7" valign="top"><?= $model->alamat_cuti ?></td>
            <td>Telepon</td>
            <td colspan="4" valign="top"><?= $model->telepon_cuti ?></td>
        </tr>
        <tr>
            <td colspan="5">
                <p>Hormat Saya,</p><br /><br />
                <div style="padding-top: 50px;">NIP: <?= $model->karyawan->nip ?></div>
            </td>
        </tr>
    </table>

    <table class="table-bordered" width="100%">
        <thead>
            <tr>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
            </tr>
        </thead>
        <tr>
            <td colspan="12">VII. PERTIMBANGAN ATASAN LANGSUNG **</td>
        </tr>
        <tr>
            <td colspan="2">Disetujui:</td>
            <td colspan="2">Perubahan ***</td>
            <td colspan="3">Ditangguhkan ***</td>
            <td colspan="7" rowspan="3" valign="top">
                <div>.................................,</div><br /><br />
                <div><u>....................................</u></div>
                <div>NIP: ...........................</div>
            </td>
        </tr>
        <tr>
            <td class="blank">&nbsp;</td>
        </tr>
        <tr>
            <td class="blank">&nbsp;</td>
        </tr>
        <tr>
            <td class="blank">&nbsp;</td>
        </tr>
    </table>

    <table class="table-bordered" width="100%">
        <thead>
            <tr>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
                <th width="8.333333%"></th>
            </tr>
        </thead>
        <tr>
            <td colspan="12">VIII. KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUTI **</td>
        </tr>
        <tr>
            <td colspan="2">Disetujui:</td>
            <td colspan="2">Perubahan ***</td>
            <td colspan="3">Ditangguhkan ***</td>
            <td colspan="7" rowspan="5">
                <table class="no-border">
                    <tr>
                        <td valign="top"><img src=" <?= Url::to('https://kpg.sitebridge.net/media/images/640px-Logo_of_the_Ministry_of_Home_Affairs_of_the_Republic_of_Indonesia.png') ?>" height="80" />
                        </td>
                        <td valign="top">
                            Ditanda tangani secara elektronik oleh:<br />
                            Sekretaris Badan<br />
                            Penelitian dan Pengembangan,<br /><br /><br /><br />

                            Dr. Kurniasih, SH, M.Si.<br />
                            Pembina Utama Madya (IV/d)<br />
                            NIP. 19631109 198903 2 001
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="blank">&nbsp;</td>
        </tr>
        <tr>
            <td class="blank">&nbsp;</td>
        </tr>
        <tr>
            <td class="blank">&nbsp;</td>
        </tr>
        <tr>
            <td class="blank">&nbsp;</td>
        </tr>
    </table>

</page>