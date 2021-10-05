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

    <p>
        <?= Html::a('Buat Baru', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'exp_year',
            // 'i_a',
            // 'i_b',
            // 'i_c',
            // 'i_d',
            'ii_a:decimal',
            'ii_b:decimal',
            'ii_c:decimal',
            'ii_d:decimal',
            'iii_a:decimal',
            'iii_b:decimal',
            'iii_c:decimal',
            'iii_d:decimal',
            //'iv_a',
            //'iv_b',
            //'iv_c',
            //'iv_d',
            //'iv_e',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>