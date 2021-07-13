<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Golongan;
use common\models\User;

$this->registerCssFile('https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css');

$this->registerJsFile(
    'https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

$this->registerJs('
defaultDate = "' . date('m/d/Y', mktime(0, 0, 0, date('m'), date('d'), date('Y') - 18)) . '";
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

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(
        ArrayHelper::map(
            User::find()->orderBy('username')->all(),
            'id',
            'email'
        ),
        ['prompt' => '']
    ) ?>

    <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_kelamin')->dropDownList(['pria' => 'Pria', 'wanita' => 'Wanita',], ['prompt' => '']) ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_lahir')->textInput() ?>

    <?= $form->field($model, 'telpon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_nikah')->dropDownList(['belum nikah' => 'Belum nikah', 'nikah' => 'Nikah',], ['prompt' => '']) ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'golongan_id')->dropDownList(
        ArrayHelper::map(
            Golongan::find()->orderBy('nama_golongan')->all(),
            'id',
            'nama_golongan'
        ),
        ['prompt' => '']
    ) ?>

    <?= $form->field($model, 'foto')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>