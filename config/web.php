<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'health-api',
    'name' => 'health-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'apiV1'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'SlCcezf7ZWpqfNbNyrAEnzn1bnopGMRT',
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
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '/',
            'rules' => [
                'GET v1/<controller>' => 'apiV1/<controller>/index',
                'POST v1/<controller>' => 'apiV1/<controller>/create',
                'GET v1/<controller>/<id:\d+>' => 'apiV1/<controller>/view',
                'PUT v1/<controller>/<id:\d+>' => 'apiV1/<controller>/update',
                'DELETE v1/<controller>/<id:\d+>' => 'apiV1/<controller>/delete',
                'OPTIONS v1/<controller>/<id:\d+>' => 'apiV1/<controller>/options',
                'OPTIONS v1/<controller>' => 'apiV1/<controller>/options',
                'v1/<controller>/<action>' => 'apiV1/<controller>/<action>',
            ],
        ],
    ],
    'modules' => [
        'apiV1' => [
            'class' => 'app\modules\apiV1\Module'
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
