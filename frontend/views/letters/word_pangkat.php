<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Letters */

$this->title = $model->ref_nomor_surat;
$this->params['breadcrumbs'][] = ['label' => 'Surat Menyurat'];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$phpWord = new \PhpOffice\PhpWord\PhpWord();
