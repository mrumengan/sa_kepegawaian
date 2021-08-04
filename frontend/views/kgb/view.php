<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Kgb */

$this->title = str_pad($model->id, $model->code_width, "0", STR_PAD_LEFT);
$this->params['breadcrumbs'][] = ['label' => 'KGB', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kgb-view">

    <h1><?= $model->karyawan->nama ?></h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="font-weight-bold"><?= str_pad($model->id, $model->code_width, "0", STR_PAD_LEFT) ?>/KGB/<?= date('my', strtotime($model->tanggal_kenaikan)) ?></h3>
                    <div><label>Tanggal Kenaikan</label>: <?= $model->tanggalKenaikan ?></div>
                    <div><label>Besar Kenaikan</label>: <?= Yii::$app->formatter->format($model->jumlah, 'currency') ?></div>
                    <p class="float-right">
                        <?php if (Yii::$app->user->can('Admin') && $model->status == 5) { ?>
                            <?= Html::a('<i class="fas fa-file-pdf"></i> Download PDF', ['download', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                            <?= Html::button('<i class="fas fa-file-pdf"></i> Upload Signed PDF', ['class' => 'btn btn-secondary', 'data-toggle' => 'modal', 'data-target' => '#modal-upload']) ?>
                        <?php } else { ?>
                            <?= Html::a('<i class="far fa-file-pdf"></i> Lihat PDF', ['pdf', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
                        <?php } ?>
                    </p><br />
                </div>
            </div>
        </div>
    </div>

</div>