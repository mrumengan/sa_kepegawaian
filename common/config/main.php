<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // 'cache' => 'cache',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'nullDisplay' => '<span class="not-set">(kosong)</span>',
            'thousandSeparator' => '.',
            'currencyDecimalSeparator' => ',',
            'numberFormatterOptions' => [NumberFormatter::MIN_FRACTION_DIGITS => 0],
            'dateFormat' => 'dd MMMM yyyy',
            'currencyCode' => 'IDR ',
            'numberFormatterSymbols' => [NumberFormatter::CURRENCY_SYMBOL => 'Rp.'],
        ],
    ],
];
