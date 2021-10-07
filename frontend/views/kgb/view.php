<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Kgb */

$this->registerJsFile(
    '@web/js/kgb.view.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

$this->registerCss('
label {
    width: 15%;
');

$this->title = str_pad($model->id, $model->code_width, "0", STR_PAD_LEFT);
$this->params['breadcrumbs'][] = ['label' => 'KGB', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kgb-view">

    <div class="row">
        <div class="col-12">
            <h1 class="font-weight-bold">Usulan Kenaikan Gaji Berkala</h1>
            <div class="card">
                <div class="card-body">
                    <h3><?= $model->karyawan->nama ?></h3>
                    <div><label class="label">Tanggal Kenaikan</label>: <?= $model->tanggalKenaikan ?></div>
                    <div><label class="label">Gaji Pokok Baru</label>: <?= Yii::$app->formatter->format($model->jumlah, 'currency') ?></div>
                    <p class="float-right">
                        <?php if (Yii::$app->user->can('Admin') && $model->status == 5) { ?>
                            <?= Html::a('<i class="fas fa-file-pdf"></i> Download Word', ['download', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                            <?= Html::button('<i class="fas fa-file-pdf"></i> Upload Signed PDF', ['class' => 'btn btn-secondary', 'data-toggle' => 'modal', 'data-target' => '#modal-upload']) ?>
                        <?php } else { ?>
                            <?= Html::a('<i class="far fa-file-pdf"></i> Lihat PDF', ['pdf', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
                        <?php } ?>
                    </p><br />
                </div>
            </div>
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
                <?php
                $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'id' => 'form-upload', 'action' => ['kgb/upload', 'id' => $model->id]]);
                $model->status = 10;
                ?>
                <?= $form->field($model, 'status')->textInput() ?>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="kgb-pdf_file" accept="application/pdf" name="Kgb[pdf_file]">
                                <label class="custom-file-label" for="kgb-pdf_file">Pilih file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-upload">Upload dan simpan</button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>