<?php

use common\components\SBHelpers;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\Presensi */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Presensi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$this->registerCssFile('https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css');

$this->registerJsFile('https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js');

$this->registerJS(
    '
var lat = ' . $model->latitude . ';
var lon = ' . $model->longitude . ';
',
    View::POS_HEAD,
    'latlon-var'
);

$this->registerJsFile('@web/js/presensis.view.js');

\yii\web\YiiAsset::register($this);

?>
<div class="presensi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->can('Admin')) : ?>
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Karyawan',
                'value' => function ($data) {
                    return $data->karyawan->nama . '<br />NIK: ' . $data->karyawan->nip;
                },
                'format' => 'raw'
            ],
            'latitude',
            'longitude',
            'address',
            [
                'attribute' => 'created_at',
                'value' => function ($data) {
                    return SBHelpers::getTanggalJam($data->created_at);
                }
            ],
            [
                'attribute' => 'photo_file',
                'value' => function ($model) {
                    return Html::img('@web/media/img/presensi/' . $model->photo_file, ['class' => 'img-thumbmnail', 'style' => 'min-width: 150px; max-width: 250px;']);
                },
                'format' => 'raw'
            ],
            [
                'label' => 'Lokasi',
                'value' => function ($model) {
                    return '<div class="col mb-3"><div id="map" style="width: 100%; height: 200px; background: silver;"></div></div>';
                },
                'format' => 'raw'
            ]
        ],
    ]) ?>

</div>