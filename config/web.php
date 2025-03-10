<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'timeZone' => 'Asia/Shanghai',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'sourceLanguage' => 'en-US',
    'language' => 'zh-CN',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\AdminModule',
        ],
        'polygon' => [
            'class' => 'app\modules\polygon\Module',
        ],
    ],
    'components' => [
        'formatter' => $params['components.formatter'],
        'setting' => $params['components.setting'],
        'assetManager' => [
            'appendTimestamp' => true,
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'J2G4Qf8xcLOk8Zuf1zKcP1YC_ydIL5GY',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'app\components\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //'<controller:[\w-]+>/<id:\d+>' => '<controller>/view',
                'p/<id:\d+>' => '/problem/view',
                'status/index' => '/solution/index',
                'standing/<id:\d+>' => '/contest/standing2'
            ],
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
            // Set the following if you want to use DB component other than
            // default 'db'.
            // 'db' => 'mydb',
            // To override default session table, set the following
            // 'sessionTable' => 'my_session',
        ],
        'security' => [
            'passwordHashCost' => 10, // 尝试调整这个值
        ],
    ],
    'params' => $params,
];

return $config;
