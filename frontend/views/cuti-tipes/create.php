<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CutiTipe */

$this->title = 'Create Cuti Tipe';
$this->params['breadcrumbs'][] = ['label' => 'Cuti Tipes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuti-tipe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
