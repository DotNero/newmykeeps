<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [

    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'mailer' =>
        [
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.yandex.ru',
        'username' => 'username',
        'password' => 'password',
        'port' => '587',
        'encryption' => 'tls',
            
        ],

        'request' => [
            'parsers' =>[
                'application/json' => 'yii\web\JsonParser',
            ],
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'JZAxeijTuG0f6pecFhia78uFNz1-FFFx',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,

            'rules' => [
                '' => 'api/site/index',
                // 'POST auth' => 'api/site/login',

                // 'GET profile' => 'profile/index',
                // 'PUT,PATCH profile' => 'profile/update',

                '<action:\w+>' => 'site/<action>',
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'api/auth' => 'api/site'
                    ],
                    'extraPatterns' => [

                        'OPTIONS login' => 'login',
                        'POST login' => 'login',
                        'OPTIONS register' => 'register',
                        'POST register' => 'register',
                        'OPTIONS student-register' => 'student-register',
                        'POST student-register' => 'student-register',
                        'OPTIONS company-register' => 'company-register',
                        'POST company-register' => 'company-register',
                        'OPTIONS add-vacancy' => 'add-vacancy',
                        'POST add-vacancy' => 'add-vacancy',
                        'OPTIONS get-vacancy' => 'get-vacancy',
                        'GET get-vacancy' =>'get-vacancy',
                        
                    ],
                    'pluralize' => false,
                ],

            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        ],
        'modules' => [
            'api' => [
                'class' => app\modules\api\Rest::class,
                'controllerMap' => [
                    'site' => \app\modules\api\controllers\SiteController::class,
                ]
            ],
            
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
