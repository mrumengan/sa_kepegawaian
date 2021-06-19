<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Golongan */

$this->title = 'Update Golongan: ' . $model->nama_golongan;
$this->params['breadcrumbs'][] = ['label' => 'Golongans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_golongan, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="golongan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>