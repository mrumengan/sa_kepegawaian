<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'SA PEG';
?>
<div class="site-index">

    <div class="body-content">

        <?php if (Yii::$app->user->isGuest) : ?>
        <?php else : ?>
            <div class="row">
                <div class="col">
                    <h2 class="border-bottom">Berita</h2>
                    <div class="row">
                        <div class="col">
                            <ul>
                                <li>
                                    <h4>Berita Pertama</h4>
                                    <p>It has survived not only five centuries, but also the leap
                                        into electronic typesetting, remaining essentially unchanged. It was popularised
                                        in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                                        and more recently with desktop publishing software like Aldus PageMaker including
                                        versions of Lorem Ipsum.</p>
                                </li>
                                <li>
                                    <h4>Berita Kedua</h4>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                        when an unknown printer took a galley of type and scrambled it to make a type
                                        specimen book.</p>
                                </li>
                                <li>
                                    <h4>Berita Ketiga</h4>
                                    <p>It has survived not only five centuries, but also the leap
                                        into electronic typesetting, remaining essentially unchanged. It was popularised
                                        in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                                        and more recently with desktop publishing software like Aldus PageMaker including
                                        versions of Lorem Ipsum.</p>
                                </li>
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
                        </div>
                        <div class="col">
                            <h3>Perubahan</h3>
                            <div>
                                <p>Perubahan</p>
                                <ol>
                                    <li>Berita Pertama</li>
                                    <li>Berita Kedua</li>
                                    <li>Berita Ketiga</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        <?php endif ?>

    </div>
</div>