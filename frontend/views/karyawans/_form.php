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
    // $action = ['karyawans/create'];
    $tgl_lahir = date('d/m/Y', mktime(0, 0, 0, date('m'), date('d'), date('Y') - 18));
    $tmt_pangkat = $tgl_lahir;
    $tmt_jabatan = $tmt_pangkat;
    $tmt_cpns = $tgl_lahir;
    $tmt_pns = $tgl_lahir;
    $tmt_gaji = $tgl_lahir;
} else {
    // $action = ['karyawans/update', 'id' => $model->id];
    $tgl_lahir = date('d/m/Y', strtotime($model->tanggal_lahir));
    $tmt_pangkat = date('d/m/Y', strtotime($model->tmt_pangkat));
    $tmt_jabatan = date('d/m/Y', strtotime($model->tmt_jabatan));
    $tmt_cpns = date('d/m/Y', strtotime($model->tmt_cpns));
    $tmt_pns = date('d/m/Y', strtotime($model->tmt_pns));
    $tmt_gaji = date('d/m/Y', strtotime($model->tmt_gaji));
}

$this->registerJs('
defaultDate = "' . $tgl_lahir . '";
minDate = new Date(new Date().getFullYear() - 18, new Date().getMonth(), new Date().getDate());
$("#karyawan-tanggal_lahir").datepicker({
    uiLibrary: "bootstrap4",
    maxDate: minDate,
    value: defaultDate,
    format: "dd/mm/yyyy",
});

minDate = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate() - 1);
$("#karyawan-tmt_pangkat").datepicker({
    uiLibrary: "bootstrap4",
    maxDate: minDate,
    value: "' . $tmt_pangkat . '",
    format: "dd/mm/yyyy",
});
$("#karyawan-tmt_jabatan").datepicker({
    uiLibrary: "bootstrap4",
    maxDate: minDate,
    value: "' . $tmt_jabatan . '",
    format: "dd/mm/yyyy",
});
$("#karyawan-tmt_cpns").datepicker({
    uiLibrary: "bootstrap4",
    maxDate: minDate,
    value: "' . $tmt_cpns . '",
    format: "dd/mm/yyyy",
});
$("#karyawan-tmt_pns").datepicker({
    uiLibrary: "bootstrap4",
    maxDate: minDate,
    value: "' . $tmt_pns . '",
    format: "dd/mm/yyyy",
});
$("#karyawan-tmt_gaji").datepicker({
    uiLibrary: "bootstrap4",
    maxDate: minDate,
    value: "' . $tmt_gaji . '",
    format: "dd/mm/yyyy",
});

');

/* @var $this yii\web\View */
/* @var $model common\models\Karyawan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="karyawan-form">

    <div class="row">
        <div class="col-9">
            <?php $form = ActiveForm::begin(); ?>

            <!-- <?= $form->field($model, 'departemen_id')->dropDownList(
                        ArrayHelper::map(
                            Departemen::find()->orderBy('nama')->all(),
                            'id',
                            'nama'
                        ),
                        ['disabled' => !\Yii::$app->user->can('Admin'), 'prompt' => '']
                    ) ?>
 -->
            <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'golongan')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'jabatan')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'tanggal_lahir')->textInput() ?>

            <?= $form->field($model, 'tmt_pangkat')->textInput() ?>

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

            <?= $form->field($model, 'user_id')->dropDownList(
                ArrayHelper::map(
                    User::find()->orderBy('username')->where(['>', 'id', 1])->all(),
                    'id',
                    'username'
                ),
                ['disabled' => !\Yii::$app->user->can('Admin'), 'prompt' => '']
            ) ?>

            <div class="form-group text-right">
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
        <div class="col-3">
            <?php if ($model->foto) { ?>
                <img src="<?= Url::to('@web/media/photo/' . $model->foto) ?>" class="img-fluid rounded img-thumbnail" />
            <?php } else { ?>
                <div class="text-center img-thumbnail img-fluid rounded" style="font-size: 10em;"><i class="fas fa-user"></i></div>
            <?php } ?>
        </div>
    </div>

</div>