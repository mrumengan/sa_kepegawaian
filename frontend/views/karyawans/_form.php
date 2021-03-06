<?php

use common\models\Departemen;
use common\models\Golongan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use common\models\User;

if ($model->isNewRecord) {
    $status_asn = strtolower(Yii::$app->request->get('status_asn', 'asn'));
} else {
    if ($model->status_asn == 10) {
        $status_asn = 'asn';
    } else {
        $status_asn = 'non-asn';
    }
}

$this->registerCssFile('https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css');
$this->registerCssFile('@web/css/karyawans.view.css');
$this->registerCssFile('@web/css/karyawans._form.css');

$this->registerJsFile(
    'https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile(
    '@web/js/karyawans._form.js',
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

            <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

            <?php if ($status_asn == 'asn') : ?>
                <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>
            <?php else : ?>
                <?= $form->field($model, 'nip')->textInput(['maxlength' => true])->label('NIK') ?>
            <?php endif; ?>

            <?php if ($status_asn == 'asn') : ?>
                <?php
                $golongans = Golongan::find()->all();
                foreach ($golongans as $golongan) {
                    $gol_ruang[$golongan->nama_golongan] = $golongan->pangkat . ' - ' . $golongan->nama_golongan;
                }
                ?>
                <?= $form->field($model, 'golongan')->dropDownList($gol_ruang) ?>
            <?php endif; ?>

            <?= $form->field($model, 'jabatan')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'tanggal_lahir')->textInput() ?>

            <?php if ($status_asn == 'asn') : ?>
                <?= $form->field($model, 'tmt_pangkat')->textInput() ?>

                <?= $form->field($model, 'tmt_jabatan')->textInput() ?>

                <?= $form->field($model, 'eselon')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'pangkat_cpns')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'tmt_cpns')->textInput() ?>

                <?= $form->field($model, 'tmt_pns')->textInput() ?>
            <?php endif; ?>

            <?= $form->field($model, 'gaji_pokok')->textInput(['maxlength' => true]) ?>

            <?php if ($status_asn == 'asn') : ?>
                <?= $form->field($model, 'tmt_gaji')->textInput() ?>
            <?php endif; ?>

            <?= $form->field($model, 'pendidikan')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'pendidikan_umum')->textInput(['maxlength' => true]) ?>

            <?php if ($status_asn == 'asn') : ?>
                <?= $form->field($model, 'diklat_struktural')->textarea([]) ?>

                <?= $form->field($model, 'diklat_fungsional')->textarea(['maxlength' => true]) ?>
            <?php endif; ?>

            <?= $form->field($model, 'jenis_kelamin')->dropDownList(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan',], ['prompt' => '']) ?>

            <?php if ($status_asn == 'asn') : ?>
                <?= $form->field($model, 'nip_lama')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'peringkat')->textInput() ?>
            <?php endif; ?>

            <?php if (strtolower($status_asn) == 'asn') $model->status_asn = 10;
            else $model->status_asn = 0; ?>
            <?= $form->field($model, 'status_asn')->dropDownList(['0' => 'Non ASN', '10' => 'ASN',], ['prompt' => '']) ?>

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
            <div class="btn-container text-right"><i class="far fa-edit" id="btn-edit-photo"></i></div>
            <?php if ($model->foto) { ?>
                <img src="<?= Url::to('@web/media/img/' . $model->foto) ?>" class="img-fluid rounded img-thumbnail" />
            <?php } else { ?>
                <div class="text-center img-thumbnail img-fluid rounded" style="font-size: 10em;"><i class="fas fa-user"></i></div>
            <?php } ?>
        </div>
    </div>

</div>

<div class="modal fade" id="modal-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'id' => 'form-upload', 'action' => ['karyawans/upload-photo', 'id' => $model->id]]); ?>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="karyawan-photo_file" accept="image/png, image/jpeg, image/jpg, image/webp" name="Karyawan[photo_file]">
                                <label class="custom-file-label" for="karyawan-photo_file">Pilih file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-upload">Upload dan simpan</button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>