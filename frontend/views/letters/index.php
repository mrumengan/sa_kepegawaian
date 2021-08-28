<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LettersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usulan ' . ucfirst(Yii::$app->controller->action->id);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letters-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Buat Usulan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'nomor_surat',
            'ref_asal_surat',
            [

                'label' => 'Nomor Asal Surat',
                'value' => 'ref_nomor_surat'
            ],
            'ref_tanggal:date',
            // 'ref_hal:ntext',
            //'sifat',
            //'lampiran',
            //'hal:ntext',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>