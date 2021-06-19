<?php

use yii\helpers\Html;
?>
<div class="card">
    <div class="card-header">
        Golongan: <?= Html::a($model->nama_golongan, ['golongan/view', 'id' => $model->id]) ?>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Gaji Pokok <span class="float-right"><?= Yii::$app->formatter->asCurrency($model->gaji_pokok) ?></span></li>
            <li class="list-group-item">Tunjangan Istri <span class="float-right"><?= Yii::$app->formatter->asCurrency($model->tunjangan_istri) ?></span></li>
            <li class="list-group-item">Tunjangan Anak<span class="float-right"><?= Yii::$app->formatter->asCurrency($model->tunjangan_anak) ?></span></li>
            <li class="list-group-item">Tunjangan Transport<span class="float-right"><?= Yii::$app->formatter->asCurrency($model->tunjangan_transport) ?></span></li>
            <li class="list-group-item">Tunjangan Makan<span class="float-right"><?= Yii::$app->formatter->asCurrency($model->tunjangan_makan) ?></span></li>
        </ul>
    </div>
</div>