<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\KgbAmount */

$this->title = 'MKG ' . $model->exp_year . ' tahun';
$this->params['breadcrumbs'][] = ['label' => 'Nilai KGB', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kgb-amount-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            '1a:decimal',
            '1b:decimal',
            '1c:decimal',
            '1d:decimal',
            '2a:decimal',
            '2b:decimal',
            '2c:decimal',
            '2d:decimal',
            '3a:decimal',
            '3b:decimal',
            '3c:decimal',
            '3d:decimal',
            '4a:decimal',
            '4b:decimal',
            '4c:decimal',
            '4d:decimal',
            '4e:decimal',
        ],
    ]) ?>

</div>