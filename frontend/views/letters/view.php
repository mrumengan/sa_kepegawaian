<?php

use common\components\SBHelpers;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Letters */

$this->title = $model->ref_nomor_surat;
$this->params['breadcrumbs'][] = ['label' => 'Surat Menyurat', 'url' => [$model->type]];
$this->params['breadcrumbs'][] = ['label' => $model->titles[$model->type]];
\yii\web\YiiAsset::register($this);

$this->registerJsFile(
    '@web/js/letters.view.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
<div class="letters-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col">
            <p class="float-right">
                <?php if (Yii::$app->user->can('Admin') && $model->status == 5) { ?>
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?php }  ?>
                <?php if (Yii::$app->user->can('Admin') && $model->status == 5) { ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php } ?>
                <?php if ($model->status > 5) { ?>
                    <?= Html::a('<i class="far fa-file-pdf"></i> Lihat PDF', ['/letters/pdf', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
                <?php } ?>
            </p>

        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'ref_nomor_surat',
                    'ref_asal_surat',
                    [
                        'attribute' => 'ref_tanggal',
                        'value' => function ($data) {
                            return SBHelpers::getTanggal($data->ref_tanggal);
                        }
                    ],
                    'ref_hal:ntext',
                    // 'nomor_surat',
                    // 'sifat',
                    'hal:ntext',
                    [
                        'label' => 'Karyawan Terkait',
                        'value' => function ($data) {
                            $employees = [];
                            foreach ($data->employees as $member) {
                                $employees[] = $member->karyawan->nama;
                            }
                            return implode('<br />', $employees);
                        },
                        'format' => 'raw'
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <p class="text-right">
                <?php if (Yii::$app->user->can('Admin') && $model->status == 5) { ?>
                    <?= Html::a('<i class="fas fa-file-pdf"></i> Download', ['download', 'id' => $model->id], ['class' => 'btn btn-dark']) ?>
                    <?= Html::button('<i class="fas fa-file-pdf"></i> Upload Signed PDF', ['class' => 'btn btn-secondary', 'data-toggle' => 'modal', 'data-target' => '#modal-upload']) ?>
                <?php } ?>
            </p>
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
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'id' => 'form-upload', 'action' => ['upload', 'id' => $model->id]]); ?>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="letters-pdf_file" accept="application/pdf" name="Letters[pdf_file]">
                                <label class="custom-file-label" for="letters-pdf_file">Pilih file</label>
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