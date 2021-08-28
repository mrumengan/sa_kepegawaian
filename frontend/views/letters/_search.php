<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LettersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="letters-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ref_nomor_surat') ?>

    <?= $form->field($model, 'ref_asal_surat') ?>

    <?= $form->field($model, 'ref_tanggal') ?>

    <?= $form->field($model, 'ref_hal') ?>

    <?php // echo $form->field($model, 'nomor_surat') ?>

    <?php // echo $form->field($model, 'sifat') ?>

    <?php // echo $form->field($model, 'lampiran') ?>

    <?php // echo $form->field($model, 'hal') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
