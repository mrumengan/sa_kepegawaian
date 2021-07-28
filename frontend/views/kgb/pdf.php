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
        <tbody>
            <tr>
                <td colspan="3">
                    <img src="<?= Url::to('https://kpg.sitebridge.net/media/images/640px-Logo_of_the_Ministry_of_Home_Affairs_of_the_Republic_of_Indonesia.png') ?>" height="150" />
                </td>
                <td colspan="9" align="center">
                    <div style="font-size: 18px; font-weight: bold;">KEMENTERIAN DALAM NEGERI</div>
                    <div style="font-size: 18px; font-weight: bold;">REPUBLIK INDONESIA</div>
                    <div style="font-size: 22px; font-weight: bold;">BADAN PENELITIAN DAN PENGEMBANGAN</div>
                    <div style="font-size: 14px;">JL. Kramat Raya Nomor 132, Jakarta Pusat Telp. 3101953; 3101955</div>
                    <div>Website litbang.kemendagri.go.id</div>
                </td>
            </tr>
            <tr>
                <td colspan="12">
                </td>
            </tr>
        </tbody>
    </table>
    <div style="border-top: 2px solid black; border-bottom: 1px solid black; height: 5px; margin-bottom: 10px;"></div>

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
        <tbody>
            <tr>
                <td colspan="2">
                    Nomor
                </td>
                <td colspan="6">: <?= str_pad($model->id, $model->code_width, "0", STR_PAD_LEFT) ?>/KGB/<?= date('my', strtotime($model->tanggal_kenaikan)) ?></td>
                <td colspan="4" rowspan="4">
                    Jakarta, <?= $model->tanggalBuat ?><br /><br />
                    Yth. Kepala KPPN Jakarta IV<br />
                    di -<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jakarta
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Sifat
                </td>
                <td colspan="4">: Segera</td>
            </tr>
            <tr>
                <td colspan="2">
                    Lampiran
                </td>
                <td colspan="4">:</td>
            </tr>
            <tr>
                <td colspan="2">
                    Hal
                </td>
                <td colspan="4">: Kenaikan Gaji Berkala</td>
            </tr>
        </tbody>
    </table>

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
        <tbody>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="8">Dengan ini diberitahukan, bahwa dengan telah dipenuhinya masa kerja dan syarat-syarat lainnya kepada:</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="3">1. Nama</td>
                <td colspan="7">: <?= $model->karyawan->nama ?></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="3">2. NIP</td>
                <td colspan="7">: <?= $model->karyawan->nip ?></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="3">3. Pangkat/Gol Ruang</td>
                <td colspan="7">: <?= $model->karyawan->golongan ?></td>
            </tr>
        </tbody>
    </table>
</page>