<?php

use common\models\Kgb;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Kgb */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'KGB', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerJsFile(
    '@web/js/kgb.karyawan.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

$this->registerCss('
label {
    width: 30%;
');
?>
<div class="kgb-karyawan">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-12">
            <?php if (count($model->kgbs) > 0) { ?>
                <?php foreach ($model->kgbs as $kgb) { ?>
                    <div class="card">
                        <div class="card-body">
                            <h3 class="font-weight-bold"><?= str_pad($kgb->id, $kgb->code_width, "0", STR_PAD_LEFT) ?>/KGB/<?= date('my', strtotime($kgb->tanggal_kenaikan)) ?></h3>
                            <div><label>Tanggal Kenaikan</label>: <?= $kgb->tanggalKenaikan ?></div>
                            <div><label>Besar Kenaikan</label>: <?= Yii::$app->formatter->format($kgb->jumlah, 'currency') ?></div>
                            <p class="float-right">
                                <?php if (Yii::$app->user->can('Admin') && $kgb->status == 5) { ?>
                                    <?= Html::a('<i class="fas fa-file-pdf"></i> Download PDF', ['download', 'id' => $kgb->id], ['class' => 'btn btn-primary']) ?>
                                    <?= Html::button('<i class="fas fa-file-pdf"></i> Upload Signed PDF', ['class' => 'btn btn-secondary', 'data-toggle' => 'modal', 'data-target' => '#modal-upload']) ?>
                                <?php } else { ?>
                                    <?= Html::a('<i class="far fa-file-pdf"></i> Lihat PDF', ['pdf', 'id' => $kgb->id], ['class' => 'btn btn-info']) ?>
                                <?php } ?>
                            </p><br />
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="d-flex justify-content-center">
                    <div class="alert alert-primary alert-dismissible fade show w-50" role="alert">
                        Belum ada data Kenaikan Gaji Berkala!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload PDF</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert">
                    Modul masih dalam pengembangan
                </div>
                <!-- <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'id' => 'form-upload', 'action' => ['cutis/upload', 'id' => $model->id]]); ?>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="kgb-pdf_file" accept="application/pdf" name="KGB[pdf_file]">
                                <label class="custom-file-label" for="kgb-pdf_file">Pilih file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group field-cuti-status has-success">
                            <label class="control-label" for="cuti-status">Status</label>
                            <?= Html::dropDownList(
                                "KGB['status']",
                                null,
                                [1 => 'tes'],
                                ['class' => 'form-control']
                            )
                            ?>
                            <div class="help-block"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-upload">Upload dan simpan</button>
            </div>
            <?php ActiveForm::end(); ?> -->
            </div>
        </div>
    </div>