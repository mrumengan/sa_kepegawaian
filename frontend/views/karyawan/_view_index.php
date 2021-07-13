<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>
<div class="karyawan-_view_index">
    <div class="card">
        <div class="card-body">
            <h3><?= Html::a($model->nama, ['/karyawan/view', 'id' => $model->id], $options = []) ?></h3>
            <p><?= $model->nip ?></p>
        </div>
    </div>
</div>