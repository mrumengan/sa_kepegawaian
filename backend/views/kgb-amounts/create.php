<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\KgbAmount */

$this->title = 'Create Kgb Amount';
$this->params['breadcrumbs'][] = ['label' => 'Kgb Amounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kgb-amount-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
