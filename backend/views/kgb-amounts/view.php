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
            'id',
            'exp_year',
            'i_a:currency',
            'i_b:currency',
            'i_c:currency',
            'i_d:currency',
            'ii_a:currency',
            'ii_b:currency',
            'ii_c:currency',
            'ii_d:currency',
            'iii_a:currency',
            'iii_b:currency',
            'iii_c:currency',
            'iii_d:currency',
            'iv_a:currency',
            'iv_b:currency',
            'iv_c:currency',
            'iv_d:currency',
            'iv_e:currency',
        ],
    ]) ?>

</div>