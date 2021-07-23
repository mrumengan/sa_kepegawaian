<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Cuti */

$this->title = str_pad($model->id, $model->code_width, "0", STR_PAD_LEFT);
$this->params['breadcrumbs'][] = ['label' => 'Cuti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerJsFile(
    '@web/js/cutis.view.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
<div class="cuti-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col">
            <p class="float-right">
                <?php if (!Yii::$app->user->can('Admin') && $model->status == 1) { ?>
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?php }  ?>
                <?php if (Yii::$app->user->can('Admin')) { ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php } ?>
            </p>

        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'karyawan.nama'
                    ],
                    'tanggal_cuti:date',
                    'jumlah',
                    [
                        'label' => 'Jenis Cuti',
                        'value' => function ($model) {
                            return $model->cutiTipe->name;
                        }
                    ],
                    'description',
                    [
                        'attribute' => 'status',
                        'value' => function ($model) {
                            return $model->statuses[$model->status];
                        }
                    ]
                ],
            ]) ?>
        </div>
    </div>
    <p class="float-right">
        <?php if (Yii::$app->user->can('Admin') && $model->status == 5) { ?>
            <?= Html::a('<i class="fas fa-file-pdf"></i> Download PDF', ['download', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::button('<i class="fas fa-file-pdf"></i> Upload Signed PDF', ['class' => 'btn btn-secondary', 'data-toggle' => 'modal', 'data-target' => '#modal-upload']) ?>
        <?php }  ?>
    </p><br />

    <div class="clearfix">&nbsp;</div>
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
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'id' => 'form-upload', 'action' => ['cutis/upload', 'id' => $model->id]]); ?>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="cuti-pdf_file" accept="application/pdf" name="Cuti[pdf_file]">
                                <label class="custom-file-label" for="cuti-pdf_file">Pilih file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <?php
                        echo $form->field($model, 'status')->dropDownList(
                            $model->statuses
                        );
                        ?>
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