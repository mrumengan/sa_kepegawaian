<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\KaryawanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Karyawans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="karyawan-index">


    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-9">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'item'],
                'itemView' => '_view_index',
            ]) ?>
        </div>
        <div class="col-md-3">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Daftar Karyawan Baru', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

        </div>
    </div>

</div>