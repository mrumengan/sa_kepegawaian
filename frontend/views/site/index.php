<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'SA PEG';
?>
<div class="site-index">

    <div class="body-content">

        <?php if (Yii::$app->user->isGuest) : ?>
        <?php else : ?>
            <div class="row news">
                <div class="col">
                    <h2 class="border-bottom">Berita</h2>
                    <div class="row">
                        <div class="col">
                            <ul>
                                <?php foreach ($news as $item) : ?>
                                    <li>
                                        <h4><?= $item->title ?></h4>
                                        <?= $item->content_preview ?>
                                        <div class="text-right"><?= Html::a('Selengkapnya >>', ['/post/view', 'id' => $item->id], ['class' => 'btn btn-secondary']) ?></div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <h2 class="border-bottom">Surat Menyurat</h2>
                    <div class="row">
                        <div class="col">
                            <?php if (isset($karyawan)) : ?>
                                <div>
                                    <h3>Cuti</h3>
                                    <dl>
                                        <?php foreach ($cutis as $cuti) : ?>
                                            <dd>- Tgl. Cuti: <?= Html::a($cuti->tanggal_cuti, ['/cutis/view', 'id' => $cuti->id], []) ?>
                                                <sup><span class="badge <?= $cuti->badges[$cuti->status] ?>"><?= $cuti->statuses[$cuti->status] ?></span></sup>
                                            </dd>
                                        <?php endforeach ?>
                                    </dl>
                                </div>
                            <?php endif; ?>
                            <?php if (Yii::$app->user->can('Admin')) : ?>
                                <div>
                                    <h3>Pengajuan Cuti</h3>
                                    <dl>
                                        <?php foreach ($cuti_karyawans as $cuti) : ?>
                                            <dd><?= Html::a($cuti->karyawan->nama, ['/cutis/view', 'id' => $cuti->id], []) ?>
                                                <sup><span class="badge <?= $cuti->badges[$cuti->status] ?>"><?= $cuti->statuses[$cuti->status] ?></span></sup>
                                            </dd>
                                        <?php endforeach ?>
                                    </dl>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col">
                            <h3>Perubahan</h3>
                            <div>
                                <p>Perubahan</p>
                                <ol>
                                    <li>Perubahan jadwal libur bersama</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        <?php endif ?>

    </div>
</div>