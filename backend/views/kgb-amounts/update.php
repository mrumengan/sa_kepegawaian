<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\KgbAmount */

$this->title = 'Ubah Nilai KGB MKG: ' . $model->exp_year . ' tahun';
$this->params['breadcrumbs'][] = ['label' => 'Nilai KGB', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'MKG ' . $model->exp_year . ' tahun', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="kgb-amount-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>