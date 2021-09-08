<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Letters */

$this->title = 'Update Letters: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Surat Menyurat', 'url' => [$model->type]];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="letters-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>