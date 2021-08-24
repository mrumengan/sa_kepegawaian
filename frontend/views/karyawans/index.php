<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\KaryawanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Pegawai - ' . $status_asn;
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
            <div class="card">
                <div class="card-header">
                    Cari Pegawai
                </div>
                <div class="card-body">
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

                </div>
                <div class="card-footer text-center">
                    <p>
                        <?= Html::a('Buat Pegawai', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>