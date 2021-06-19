<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\KaryawanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="karyawan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nip') ?>

    <?= $form->field($model, 'nik') ?>

    <?= $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'jenis_kelamin') 
    ?>

    <?php // echo $form->field($model, 'tempat_lahir') 
    ?>

    <?php // echo $form->field($model, 'tanggal_lahir') 
    ?>

    <?php // echo $form->field($model, 'telpon') 
    ?>

    <?php // echo $form->field($model, 'agama') 
    ?>

    <?php // echo $form->field($model, 'status_nikah') 
    ?>

    <?php // echo $form->field($model, 'alamat') 
    ?>

    <?php // echo $form->field($model, 'golongan_id') 
    ?>

    <?php // echo $form->field($model, 'foto') 
    ?>

    <?php // echo $form->field($model, 'created_at') 
    ?>

    <?php // echo $form->field($model, 'created_by') 
    ?>

    <?php // echo $form->field($model, 'updated_at') 
    ?>

    <?php // echo $form->field($model, 'updated_by') 
    ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>