<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\View;
use common\components\SBHelpers;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PresensiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan Presensi';
$this->params['breadcrumbs'][] = ['label' => 'Presensi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css');
$this->registerCssFile("https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css", [
    'depends' => [\yii\bootstrap4\BootstrapAsset::class],
], 'css-print-theme');

$this->registerJsFile(
    'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js',
    [
        'depends' => [\yii\web\JqueryAsset::class]
    ]
);
$this->registerJsFile(
    'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js',
    [
        'depends' => [\yii\web\JqueryAsset::class]
    ]
);
$this->registerJsFile(
    '@web/js/presensis-reports.js',
    [
        'depends' => [\yii\web\JqueryAsset::class]
    ]
);

$this->registerJS(
    '
    var urlDownload = \'' . Url::to(['/presensis/download']) . '\';
    var dateStart = \'' . $date_start . '\';
    var dateEnd = \'' . $date_end . '\';
',
    View::POS_HEAD
)
?>
<div class="presensi-reports">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'action' => ['reports'],
        'method' => 'get',
    ]); ?>
    <div class="text-right d-flex justify-content-end">

        <?= $form->field($model, 'created_at_start')->hiddenInput()->label(false); ?>
        <?= $form->field($model, 'created_at_end')->hiddenInput()->label(false) ?>

        <div id="report-range" class="mr-3" style="
        background: #fff;
        cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; display: inline-block; line-height: 1.2em; height: 2em;">
            <i class="fa fa-calendar"></i>&nbsp;
            <span></span> <i class="fa fa-caret-down"></i>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary btn-sm']) ?>
            <?= Html::button('Unduh XLS', ['id' => 'btn-download', 'class' => 'btn btn-outline-primary btn-sm']) ?>
        </div>

    </div>
    <?php ActiveForm::end(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Karyawan',
                'value' => function ($data) {
                    return $data->karyawan->nama . '<br />NIK: ' . $data->karyawan->nip;
                },
                'format' => 'raw'
            ],
            'latitude',
            'longitude',
            [
                'attribute' => 'address',
                'value' => function ($data) {
                    return '<strong>' . strtoupper($data->work_from) . '</strong><br />' . $data->address;
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($data) {
                    return SBHelpers::getTanggalJam($data->created_at);
                }
            ],
        ],
    ]); ?>


</div>