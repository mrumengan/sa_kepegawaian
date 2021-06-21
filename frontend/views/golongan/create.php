<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Golongan */

$this->title = 'Buat Golongan';
$this->params['breadcrumbs'][] = ['label' => 'Golongan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="golongan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>