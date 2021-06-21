<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Golongan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="golongan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_golongan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gaji_pokok')->textInput() ?>

    <?= $form->field($model, 'tunjangan_istri')->textInput() ?>

    <?= $form->field($model, 'tunjangan_anak')->textInput() ?>

    <?= $form->field($model, 'tunjangan_transport')->textInput() ?>

    <?= $form->field($model, 'tunjangan_makan')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
