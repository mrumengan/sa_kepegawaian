<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Kgb */

$this->title = 'Update Kgb: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kgbs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kgb-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
