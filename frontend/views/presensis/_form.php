<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\Presensi */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile('https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css');

$this->registerJsFile('https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js');

$this->registerJsFile('@web/js/presensis._form.js');

$model->karyawan_id = Yii::$app->user->karyawanId;
$model->work_from = $location;
?>

<div class="presensi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'karyawan_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'latitude')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'longitude')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'address')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'work_from')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'photo_data')->hiddenInput()->label(false) ?>

    <div class="row">
        <div class="col text-center mb-3">
            <video id="video" width="320" height="180" autoplay style="margin: 0 auto;" class="d-block"></video>
            <canvas id="canvas" width="1280" height="720" style="margin: 0 auto;" class="d-none"></canvas>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <div id="map" style="width: 100%; height: 200px; background: silver;"></div>
        </div>
    </div>

    <div class="form-group">
        <div class="col text-center mt-2">
            <button id="start-camera" type="button" class="btn btn-dark">Kamera</button>
            <button id="click-photo" type="button" class="btn btn-success">Ambil Photo</button>
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <img src="" id="test-image" />
    <?php ActiveForm::end(); ?>

</div>