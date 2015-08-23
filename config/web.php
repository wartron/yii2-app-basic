<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'authManager'  => [
            'class' => 'yii\rbac\DbManager',
        ],
        'urlManager'   => [
            'enablePrettyUrl' =>  true,
            'showScriptName'  =>  false,
        ],
        'authClientCollection' => [
            'class'   => \yii\authclient\Collection::className(),
            'clients' => [
                'github' => [
                    'class'        => 'wartron\yii2account\clients\GitHub',
                    'clientId'     => '29df592e3c69eb149b45',
                    'clientSecret' => '55362a84cb87a1d87ce489d2164ffaab2501a8db',
                ],
                // 'bitbucket' => [
                //     'class'        => 'app\bitbucket\BitBucket',
                //     'consumerKey'     => 'WmG9Gm8Lf4preVAnTE',
                //     'consumerSecret' => 'kgES9VV3jZtkWnrhFdDU3DwYqT9qG26B',
                // ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'zxczxczxczxczxc',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
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
    ],
    'modules' => [
        'account' => [
            'class' => 'wartron\yii2account\Module',
            'defaultRoute'  => 'profile',
            'admins'        => ['admin','adminxx2'],
            'enableFlashMessages'   => false,
            'enableConfirmation'    =>  false,
        ],
        'rbac' => [
            'class' => 'wartron\yii2account\rbac\Module',
            'enableFlashMessages'   =>  false
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $allowedIPs = [
        '127.0.0.1',
        '::1',
        '192.168.*',
        '172.17.*'
    ];


    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => $allowedIPs
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => $allowedIPs
    ];
}

return $config;
