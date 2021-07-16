<?php

use common\models\Departemen;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use common\models\User;

$this->registerCssFile('https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css');

$this->registerJsFile(
    'https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

if ($model->isNewRecord) {
    $action = ['karyawans/create'];
    $default_date = date('m-d-Y', mktime(0, 0, 0, date('m'), date('d'), date('Y') - 18));
} else {
    $action = ['karyawans/update', 'id' => $model->id];
    $default_date = date('m-d-Y', strtotime($model->tanggal_lahir));
}

$this->registerJs('
defaultDate = "' . $default_date . '";
minDate = new Date(new Date().getFullYear() - 18, new Date().getMonth(), new Date().getDate());
$("#karyawan-tanggal_lahir").datepicker({
    uiLibrary: "bootstrap4",
    maxDate: minDate,
    value: defaultDate
});
');

/* @var $this yii\web\View */
/* @var $model common\models\Karyawan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="karyawan-form">

    <?php $form = ActiveForm::begin(['action' => $action]); ?>

    <?= $form->field($model, 'user_id')->dropDownList(
        ArrayHelper::map(
            User::find()->orderBy('username')->where(['>', 'id', 1])->all(),
            'id',
            'username'
        ),
        ['prompt' => '']
    ) ?>

    <?= $form->field($model, 'departemen_id')->dropDownList(
        ArrayHelper::map(
            Departemen::find()->orderBy('nama')->all(),
            'id',
            'nama'
        ),
        ['prompt' => '']
    ) ?>

    <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_lahir')->textInput() ?>

    <?= $form->field($model, 'golongan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tmt_pangkat')->textInput() ?>

    <?= $form->field($model, 'jabatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tmt_jabatan')->textInput() ?>

    <?= $form->field($model, 'eselon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pangkat_cpns')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tmt_cpns')->textInput() ?>

    <?= $form->field($model, 'tmt_pns')->textInput() ?>

    <?= $form->field($model, 'gaji_pokok')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tmt_gaji')->textInput() ?>

    <?= $form->field($model, 'pendidikan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pendidikan_umum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diklat_struktural')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diklat_fungsional')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_kelamin')->dropDownList(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan',], ['prompt' => '']) ?>

    <?= $form->field($model, 'nip_lama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'peringkat')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>