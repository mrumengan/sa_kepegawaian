<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Karyawan */

$status_asn = strtolower(Yii::$app->request->get('status_asn', 'asn'));

$this->title = 'Tambah Karyawan';
$this->params['breadcrumbs'][] = ['label' => 'Karyawan', 'url' => [$status_asn]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="karyawan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'status_asn' => $status_asn
    ]) ?>

</div>