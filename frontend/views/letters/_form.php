<?php

use common\components\SBHelpers;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Letters */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="letters-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="title">Dasar Surat</h3>
        </div>
        <div class="card-body">
            <?= $form->field($model, 'ref_asal_surat')->dropDownList(['SEKJEN' => 'Sekretaris Jenderal', 'KBK' => 'Kepala Biro Kepegawaian']) ?>

            <?= $form->field($model, 'ref_nomor_surat')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'ref_tanggal')->textInput() ?>

            <?= $form->field($model, 'ref_hal')->textarea(['rows' => 6]) ?>
        </div>
    </div><br />

    <div class="card">
        <div class="card-header">
            <h3 class="title">Usulan Surat</h3>
        </div>
        <div class="card-body">
            <?= $form->field($model, 'type')->hiddenInput()->label(false) ?>
            <!-- <?= $form->field($model, 'nomor_surat')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'sifat')->textInput(['maxlength' => true]) ?> -->

            <?= $form->field($model, 'lampiran')->textInput() ?>

            <?= $form->field($model, 'hal')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-sm btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>