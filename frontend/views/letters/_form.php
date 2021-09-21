<?php

use common\components\SBHelpers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\Letters */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile('//unpkg.com/@yaireo/tagify/dist/tagify.css');
$this->registerJS(
    '
let employeeListUrl = "' . Url::to(['karyawans/list-filter']) . '";
',
    View::POS_HEAD
);
$this->registerJSFile(
    '//unpkg.com/@yaireo/tagify'
);
$this->registerJSFile(
    '//unpkg.com/@yaireo/tagify@3.1.0/dist/tagify.polyfills.min.js'
);
$this->registerJSFile(
    '//unpkg.com/@yaireo/tagify@3.1.0/dist/jQuery.tagify.min.js',
    ['depends' => [\yii\web\JqueryAsset::class, \yii\bootstrap4\BootstrapPluginAsset::class]]
);
$this->registerJSFile(
    '@web/js/letters._form.js',
    ['depends' => [\yii\web\JqueryAsset::class, \yii\bootstrap4\BootstrapPluginAsset::class]]
);
?>
<div class="letters-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="title">Dasar Surat</h3>
        </div>
        <div class="card-body">
            <?= $form->field($model, 'ref_asal_surat')->dropDownList(['SEKJEN' => 'Sekretaris Jenderal', 'KBK' => 'Kepala Biro Kepegawaian']) ?>

            <?= $form->field($model, 'ref_nomor_surat')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'ref_tanggal')->textInput() ?>

            <?= $form->field($model, 'ref_hal')->textarea(['rows' => 6]) ?>
        </div>
    </div><br />

    <div class="card">
        <div class="card-header">
            <h3 class="title">Usulan Surat</h3>
        </div>
        <div class="card-body">
            <?= $form->field($model, 'type')->hiddenInput()->label(false) ?>
            <!-- <?= $form->field($model, 'nomor_surat')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'sifat')->textInput(['maxlength' => true]) ?> -->

            <?= $form->field($model, 'members')->textInput(['class' => '']) ?>

            <?= $form->field($model, 'hal')->textarea(['rows' => 6]) ?>

            <div class="form-group text-right">
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-sm btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>