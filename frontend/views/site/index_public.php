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
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active" style="padding: 50px 50px;">
                        <div class="row">
                            <div class="col">
                                <h1>SIKRAMAT</h1>
                                <h3>(Sistim Informasi Kepegawaian Ramah dan Cepat)</h3>
                                <div>Badan Penelitian dan Pengembangan</div>
                                <div>Kementrian Dalam Negeri</div>
                            </div>
                            <div class="col-2 text-right">
                                <img src="<?= Url::to('@web/media/images/640px-Logo_of_the_Ministry_of_Home_Affairs_of_the_Republic_of_Indonesia.png') ?>" height="200" />
                            </div>
                        </div>
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

    </div>
</div>