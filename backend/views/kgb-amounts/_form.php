<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\KgbAmount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kgb-amount-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'exp_year')->textInput(['readonly' => true]) ?>

    <div class="row">
        <div class="col number"><?= $form->field($model, '1a')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, '1b')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, '1c')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, '1d')->textInput() ?></div>
    </div>

    <div class="row">
        <div class="col number"><?= $form->field($model, '2a')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, '2b')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, '2c')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, '2d')->textInput() ?></div>
    </div>

    <div class="row">
        <div class="col number"><?= $form->field($model, '3a')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, '3b')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, '3c')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, '3d')->textInput() ?></div>
    </div>

    <div class="row">
        <div class="col number"><?= $form->field($model, '4a')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, '4b')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, '4c')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, '4d')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, '4e')->textInput() ?></div>
    </div>


    <div class="row">
        <div class="col text-right">
            <div class="form-group">
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>