<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Kgb */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'KGB', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kgb-karyawan">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-12">
            <?php if (count($model->kgbs) > 0) { ?>
                <?php foreach ($model->kgbs as $kgb) { ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="font-weight-bold"><?= str_pad($kgb->id, $kgb->code_width, "0", STR_PAD_LEFT) ?></div>
                            <div>Tanggal Kenaikan: <?= Yii::$app->formatter->format($kgb->tanggal_kenaikan, 'date') ?></div>
                            <div>Besar Kenaikan: <?= Yii::$app->formatter->format($kgb->jumlah, 'currency') ?></div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="d-flex justify-content-center">
                    <div class="alert alert-primary alert-dismissible fade show w-50" role="alert">
                        Belum ada data Kenaikan Gaji Berkala!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</div>