<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use common\models\Karyawan;

$this->registerCssFile('https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css');

$this->registerJsFile(
    'https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

if ($model->isNewRecord) {
    $tanggal_kenaikan = date('d/m/Y', mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')));
} else {
    $tanggal_kenaikan = date('d/m/Y', strtotime($model->tanggal_kenaikan));
}

$this->registerJs('
tanggalKenaikan = "' . $tanggal_kenaikan . '";
minDate = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()+1);
$("#kgb-tanggal_kenaikan").datepicker({
    uiLibrary: "bootstrap4",
    minDate: minDate,
    value: tanggalKenaikan,
    format: "dd/mm/yyyy",
});
');

/* @var $this yii\web\View */
/* @var $model common\models\Kgb */
/* @var $form yii\widgets\ActiveForm */
$model->karyawan_id = $karyawan->id;
?>

<div class="kgb-form">
    <h2><?= $karyawan->nama ?> - <?= $karyawan->nip ?></h2>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'karyawan_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'jumlah')->textInput() ?>

    <?= $form->field($model, 'tanggal_kenaikan')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>