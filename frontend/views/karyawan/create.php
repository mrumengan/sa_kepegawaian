<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Karyawan */

$this->title = 'Daftar Karyawan Baru';
$this->params['breadcrumbs'][] = ['label' => 'Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="karyawan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>