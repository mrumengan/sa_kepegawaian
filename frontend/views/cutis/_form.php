<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use common\models\Karyawan;

$this->registerCssFile('https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css');

$this->registerJsFile(
    'https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

if ($model->isNewRecord) {
    $action = 'cutis/create';
    $default_date = date('d/m/Y', mktime(0, 0, 0, date('m'), date('d') + 7, date('Y')));
} else {
    $action = ['cutis/update', 'id' => $model->id];
    $default_date = date('d/m/Y', strtotime($model->tanggal_cuti));
}

$this->registerJs('
defaultDate = "' . $default_date . '";
minDate = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()+7);
$("#cuti-tanggal_cuti").datepicker({
    uiLibrary: "bootstrap4",
    minDate: minDate,
    value: defaultDate
});
');

/* @var $this yii\web\View */
/* @var $model common\models\Cuti */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="cuti-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php if (isset($karyawan)) {
        $model->karyawan_id = $karyawan->id;
        echo $form->field($karyawan, 'nama')->textInput(['disabled' => 'disabled']);
        echo $form->field($model, 'karyawan_id')->hiddenInput()->label(false);
    } else {
        echo $form->field($model, 'karyawan_id')->dropDownList(
            ArrayHelper::map(
                Karyawan::find()->orderBy('nama')->all(),
                'id',
                'nama'
            ),
            ['prompt' => 'Pilih Karyawan']
        );
    } ?>

    <?= $form->field($model, 'tanggal_cuti')->textInput() ?>

    <?= $form->field($model, 'jumlah')->textInput(['placeholder' => 'dalam hari']) ?>

    <?php if ($model->isNewRecord) {
        echo $form->field($model, 'status')->dropDownList(
            $model->statuses,
            ['prompt' => 'Pilih Status']
        );
    } else {
        $model->status = $model->statuses[$model->status];
        echo $form->field($model, 'status')->textInput(['disabled' => 'disabled']);
    }
    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>