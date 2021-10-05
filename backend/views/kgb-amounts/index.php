<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nilai KGB';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kgb-amount-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a('Buat Baru', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'exp_year',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>