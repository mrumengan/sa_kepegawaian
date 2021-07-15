<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use common\models\User;
use common\models\Departemen;

/* @var $this yii\web\View */
/* @var $model common\models\KaryawanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="karyawan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'nip') ?>

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

    <?php // echo $form->field($model, 'tempat_lahir') 
    ?>

    <?php // echo $form->field($model, 'tanggal_lahir') 
    ?>

    <?php // echo $form->field($model, 'golongan') 
    ?>

    <?php // echo $form->field($model, 'tmt_pangkat') 
    ?>

    <?php // echo $form->field($model, 'jabatan') 
    ?>

    <?php // echo $form->field($model, 'tmt_jabatan') 
    ?>

    <?php // echo $form->field($model, 'eselon') 
    ?>

    <?php // echo $form->field($model, 'pangkat_cpns') 
    ?>

    <?php // echo $form->field($model, 'tmt_cpns') 
    ?>

    <?php // echo $form->field($model, 'tmt_pns') 
    ?>

    <?php // echo $form->field($model, 'gaji_pokok') 
    ?>

    <?php // echo $form->field($model, 'tmt_gaji') 
    ?>

    <?php // echo $form->field($model, 'pendidikan') 
    ?>

    <?php // echo $form->field($model, 'pendidikan_umum') 
    ?>

    <?php // echo $form->field($model, 'diklat_struktural') 
    ?>

    <?php // echo $form->field($model, 'diklat_fungsional') 
    ?>

    <?php // echo $form->field($model, 'jenis_kelamin') 
    ?>

    <?php // echo $form->field($model, 'nip_lama') 
    ?>

    <?php // echo $form->field($model, 'peringkat') 
    ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>