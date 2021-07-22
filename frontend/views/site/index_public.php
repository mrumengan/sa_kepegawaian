<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

$this->title = 'Beranda';

?>
<div class="site-index">

    <div class="body-content">
        <div class="carousel-container">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/media/images/POSTERORTALA.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/media/images/zonaintegritas.jpeg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/media/images/PosterSikerjaZI.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div><br /><br /><br />

        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center animate__animated animate__fadeInDown">Tentang Sikramat</h2>
                <p class="text-center animate__animated animate__fadeInUp">Aplikasi berbasis web milik kementerian
                    dalam negeri bagian penelitian dan pengembangan yang digunakan untuk melakukan penilaian dan pengukuran kinerja PNS berdasarkan instrumen
                    analisis jabatan dan analisis beban kerja dan menjadi dasar perhitungan produktifitas kerja dalam pemberian tunjangan kinerja.</p>
            </div><br /><br />

            <div class="row">
                <div class="col-md-6 col-sm-12 animate__animated animate__fadeInLeft">
                    <h3 class="column-title">Video Intro</h3>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe width="420" height="315" src="https://www.youtube.com/embed/mef2bK7uYs0" frameborder="0" allowfullscreen=""></iframe>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 animate__animated animate__fadeInRight">
                    <h3 class="column-title">Deskripsi Umum Aplikasi</h3>
                    <p style="text-align: justify;">Biro kepegawaian melakukan monitoring dan evaluasi penilaian kinerja aparatur kementerian dalam negeri. Monitoring dan evaluasi dilakukan oleh tim monitoring dan evaluasi aplikasi Sikramat, yang ditetapkan dengan keputusan menteri dalam negeri, hasil monitoring dan evaluasi disampaikan kepada menteri dalam negeri melalui sekretaris jenderal sebagai bahan pengembangan aplikasi Sikramat, dalam pelaksanaan tugasnya, tim monitoring dan evaluasi aplikasi Sikramat didukung oleh tenaga ahli yang berkompeten di bidangnya.</p>

                    <a href="<?= Url::to(['/site/login']) ?>" class="btn btn-primary">Masuk</a>

                </div>
            </div><br /><br />

            <section id="features">
                <div class="container">
                    <div class="section-header">
                        <h2 class="section-title text-center wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">Sikramat SAAT INI</h2>
                        <!-- <p class="text-center wow fadeInDown">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p> -->
                    </div>
                    <div class="row">
                        <div class="col-sm-6 animate__animated animate__fadeInLeft">
                            <img class="img-responsive" src="/media/images/main-feature.png" alt="">
                        </div>
                        <div class="col-sm-6">
                            <div class="media service-box wow fadeInRight animated" style="visibility: visible; animation-name: fadeInRight;">
                                <div class="pull-left">
                                    <i class="fa fa-cubes"></i>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">SKP</h4>
                                    <p style="text-align: justify;">Sasaran Kinerja Pegawai (SKP) adalah rencana dan target kinerja yang harus dicapai oleh pegawai dalam kurun waktu penilaian yang bersifat nyata dan dapat diukur serta disepakati pegawai dan atasannya.</p>
                                </div>
                            </div>

                            <div class="media service-box wow fadeInRight animated" style="visibility: visible; animation-name: fadeInRight;">
                                <div class="pull-left">
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Tugas Tambahan dan Kreativitas</h4>
                                    <p style="text-align: justify;">Selain melakukan kegiatan tugas pokok yang ada dalam SKP, seorang PNS dapat melaksanakan tugas lain atau tugas tambahan yang diberikan oleh atasannya
                                        langsung dan dibuktikan dengan surat keterangan dibuat.</p>
                                    <p style="text-align: justify;"> Tugas tambahan merupakan uraian tugas yang kita kerjakan tetapi tidak termasuk dalam perjanjian
                                        uraian tugas SKP dengan.</p>
                                </div>
                            </div>

                            <div class="media service-box wow fadeInRight animated" style="visibility: visible; animation-name: fadeInRight;">
                                <div class="pull-left">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Integrasi Transaksi Sikramat lama dengan SKP</h4>
                                    <p style="text-align: justify;">Setelah dilakukan pelaporan hasil pekerjaan pada transaksi, setelah disetujui oleh atasan langsung PNS tidak hanya mendapatkan Realisasi Menit Kerja Efektif, Persentase Realisasi
                                        Menit Kerja Efektif dan Tunjangan Kinerja. Akan tetapi mendapatkan realisasi SKP berdasarkan rencana dan target SKP yang telah disepakati oleh atasan langsung.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

        <section class="cta3" style="padding-top: 10px;padding-bottom: 10px;">
            <div class="container-fluid">
                <div class="container-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="contact-form">
                                    <h1 style="color: #fff;">HELP DESK</h1>
                                    <address>
                                        <strong>Kementerian Dalam Negeri, Biro Kepegawaian, Lt 3 Gedung D</strong><br>
                                        Jl. Medan Merdeka Utara No. 7, RT. 5/RW. 2, Gambir, Kota Jakarta Pusat<br>
                                        Daerah Khusus Ibukota Jakarta<br>
                                        <abbr title="Phone">Telp:</abbr> (021) 3450038 <abbr title="Phone">Ext:</abbr> 2349 &amp; 2355<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (021) 3524543<br>
                                        <abbr title="Whatsapp">Whatsapp:</abbr> 087884576154<br>
                                        Email : sikerja@kemendagri.go.id
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>