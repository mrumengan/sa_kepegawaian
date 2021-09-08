<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Letters */

$this->title = 'Surat ' . $model->titles[$model->type];
$this->params['breadcrumbs'][] = ['label' => 'Surat Menyurat', 'url' => [$model->type]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letters-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>