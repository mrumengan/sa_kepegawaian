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
        <div class="col number"><?= $form->field($model, 'i_a')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, 'i_b')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, 'i_c')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, 'i_d')->textInput() ?></div>
    </div>

    <div class="row">
        <div class="col number"><?= $form->field($model, 'ii_a')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, 'ii_b')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, 'ii_c')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, 'ii_d')->textInput() ?></div>
    </div>

    <div class="row">
        <div class="col number"><?= $form->field($model, 'iii_a')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, 'iii_b')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, 'iii_c')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, 'iii_d')->textInput() ?></div>
    </div>

    <div class="row">
        <div class="col number"><?= $form->field($model, 'iv_a')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, 'iv_b')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, 'iv_c')->textInput() ?></div>
        <div class="col number"><?= $form->field($model, 'iv_d')->textInput() ?></div>
    </div>

    <div class="row justify-content-end">
        <div class="col col-3 number"><?= $form->field($model, 'iv_e')->textInput() ?></div>
    </div>
    <div class="row">
        <div class="col text-right">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>



    <?php ActiveForm::end(); ?>

</div>