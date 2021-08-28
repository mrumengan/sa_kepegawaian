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
            // 'thousandSeparator' => '.',
            // 'currencyDecimalSeparator' => ',',
            'dateFormat' => 'dd MMMM yyyy',
            'currencyCode' => 'IDR',
            'numberFormatterSymbols' => [360 => 'Rp.'],
        ],
    ],
];
