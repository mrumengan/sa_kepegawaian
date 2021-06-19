<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Golongan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="golongan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col">
            <p class="float-right">
                <?= Html::a('Buat Golongan', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
    </div>


    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{summary}\n<ul class=\"list-group list-group-flush d-flex flex-row flex-wrap\">{items}</ul>\n{pager}",
        'itemOptions' => ['tag' => 'li', 'class' => 'list-group-item', 'style' => 'width: 50%; border: 0'],
        'itemView' => '_view',
    ]) ?>


</div>