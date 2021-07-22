<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Cuti */

$this->title = str_pad($model->id, $model->code_width, "0", STR_PAD_LEFT);
$this->params['breadcrumbs'][] = ['label' => 'Cuti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerCssFile('@web/js/dropzone/basic.min.css');
$this->registerCssFile('@web/js/dropzone/dropzone.min.css');
$this->registerCss('
#supload-receiver {
    background: #ffffff;
    height: 200px;
    width: 100%;
    border-radius: 5px;
}
.dropzone .dz-preview .dz-image {
    width: 250px;
    height: 250px;
}
');
$this->registerJsFile(
    '@web/js/dropzone/dropzone.min.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile(
    '@web/js/cutis.upload.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
<div class="cuti-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'karyawan.nama'
                    ],
                    'tanggal_cuti:date',
                    'jumlah',
                    [
                        'label' => 'Tipe Cuti',
                        'value' => function ($model) {
                            return $model->cutiTipe->description;
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function ($model) {
                            return $model->statuses[$model->status];
                        }
                    ]
                ],
            ]) ?>
        </div>
        <div class="col-6">
            <div id="upload-receiver" class="dropzone text-center" data-url="<?= Url::to(['cutis/upload', 'id' => $model->id]) ?>" data-view="<?= Url::to(['cutis/view', 'id' => $model->id]) ?>"></div>
        </div>
    </div><br />
</div>