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
            <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="3">4. Kantor / Tempat</td>
                <td colspan="7">: -</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="3">5. Gaji Pokok Lama</td>
                <td colspan="7">: -</td>
            </tr>
            <tr>
                <td colspan="12" style="text-align: center;">
                    <br />
                    (atas dasar SKP. Terakhir tentang gaji/pangkat yang ditetapkan)
                    <br />&nbsp;
                </td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
                <td colspan="2">a. Oleh Pejabat</td>
                <td colspan="7">: -</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
                <td colspan="2">b. Tanggal</td>
                <td colspan="7">: -</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
                <td colspan="2"> &nbsp; &nbsp; Nomor</td>
                <td colspan="7">: -</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
                <td colspan="3">c. Tanggal berlakunya</td>
                <td colspan="6">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
                <td colspan="2"> &nbsp; &nbsp; Gaji Tersebut</td>
                <td colspan="7">: -</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
                <td colspan="3">d. Masa kerja golongan</td>
                <td colspan="6">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
                <td colspan="2"> &nbsp; &nbsp; pada tanggal tsb</td>
                <td colspan="7">: -</td>
            </tr>
            <tr>
                <td colspan="12" style="text-align: center;">
                    <br />
                    Diberikan kenaikan gaji berkala hingga memperoleh:
                    <br />&nbsp;
                </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="3">6. Gaji Pokok Baru</td>
                <td colspan="7">: -</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="3">7. Berdasarkan masa kerja</td>
                <td colspan="7">: -</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="3">8. Dalam golongan/ruang</td>
                <td colspan="7">: -</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="3">9. Mulai tanggal</td>
                <td colspan="7">: -</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="3">10. Kenaikan Gaji Berkala</td>
                <td colspan="7">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="3">&nbsp; &nbsp; &nbsp; berikutnya</td>
                <td colspan="7">: -</td>
            </tr>
            <tr>
                <td colspan="12">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="10">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Diharapkan agar sesuai dengan Peraturan Pemerintah Nomor 15 Tahun 2019 kepada pegawai tersebut dapat dibayarkan penghasilannya berdasarkan gaji pokok yang baru.</td>
            </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
                <td colspan="7">a.n. Menteri Dalam Negeri<br />
                    &nbsp; &nbsp; &nbsp; &nbsp;Kepala Badan Penelitian dan Pengembangan<br />
                    &nbsp; &nbsp; &nbsp; &nbsp;u.b<br />
                    &nbsp; &nbsp; &nbsp; &nbsp;Sekretaris Badan,
                </td>
            </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
                <td colspan="7"><br /><br /><br /><br /><br /><br /><br /><br />
                    &nbsp; &nbsp; &nbsp; &nbsp;Dr. Kurniasih, SH., M.Si<br />
                    &nbsp; &nbsp; &nbsp; &nbsp;Pembina Utama Madya (IV/d)<br />
                    &nbsp; &nbsp; &nbsp; &nbsp;NIP. 19631109 198903 2 001
                </td>
            </tr>
            <tr>
                <td colspan="12">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="12">Tembusan surat ini dikirim kepada:
                    <ol>
                        <li>Ketua Badan Pemeriksa Keuangan di Jakarta;</li>
                        <li>Kepala Badan Kepegawaian Negara di Jakarta;</li>
                        <li>Kepala BKN Up. Deputi TU Kepegawaian di Jakarta;</li>
                        <li>Kepala Biro Kepegawaian Kementerian Dalam Negeri di Jakarta;</li>
                        <li>Kepala Badan Penelitian dan Pengembangan Kemendagri;</li>
                        <li>Bendaharawan Badan Litbang Kemendagri;</li>
                        <li>Pegawai yang bersangkutan.</li>
                    </ol>
                </td>
            </tr>
        </tbody>
    </table>
</page>