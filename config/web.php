<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    //'layout' => 'basic',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@net' => '@vendor/net',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'etrf245t3245td1#F$%Yt#%y6#%^y%^yg56y45%^yg',
            'enableCsrfValidation' => false,
            'baseUrl' => '',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'asArray' => true,
                ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            //'class' => 'yii\caching\DummyCache',
        ],
        'cacheApc' => [
            'class' => 'yii\caching\ApcCache',
        ],
        'dummyCache' => [
            'class' => 'yii\caching\DummyCache',
        ],
        'user' => [
            //'class' => 'yii\web\User',
            'identityClass' => 'app\models\Clients',
            'enableAutoLogin' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'PHPMailer' => [
            'class' => 'app\models\PHPMailer',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            //'class'          => 'gulltour\phpmailer\Mailer',
            'messageConfig' => [
                'from' => ['bot@allamerican-parts.com' => 'bot'],
            ],
            'useFileTransport' => false,

            /*'viewPath'         => '@common/mail',
            'config'           => [
                'mailer'     => 'smtp',
                'host'       => 'mx1.autozap.ru',
                'port'       => '25',
                'smtpsecure' => 'ssl',
                'smtpauth'   => true,
                'username'   => 'support',
                'password'   => '6JRf5j9JH9l4',
            ],*/

            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'ssl://mx1.autozap.ru',
                'username' => 'support',
                'password' => '6JRf5j9JH9l4',
                'port' => '25',
                //'encryption' => 'ssl',
            ],
            /*'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mail.com',
                'username' => 'bot@allamerican-parts.com',
                'password' => '#90xxuXYisLI',
                'port' => '465',
                'encryption' => 'ssl',
            ],*/
            /*'transport' => [

                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'strlelets60@yandex.ru',
                'password' => '5r4ewq321',
                'port' => '465',
                'encryption' => 'ssl',
            ],*/
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


                '<action:signin>' => 'site/<action>',
                '<action:registration>' => 'site/<action>',
                '<action:forgotpass>' => 'site/<action>',
                '<action:logout>' => 'site/<action>',
                '<action:checkout>' => 'site/<action>',
                '<action:invoices>' => 'site/<action>',
                '<action:invoices>/<inv:(.*)>' => 'site/<action>',


                '<action:mydata>' => 'site/<action>',
                '<action:changepassword>' => 'site/<action>',

                '<action:tester>' => 'site/<action>',


                //Logistic yii2
                '<action:about>.php' => 'site/<action>',
                '<action:question>.php' => 'site/<action>',
                '<action:revievs>.php' => 'site/<action>',
                '<action:contact>.php' => 'site/<action>',
                '<action:terms_and_conditions_of_personal_data>' => 'site/<action>',
                '<action:cookie_policy>' => 'site/<action>',

                //services
                'services/<action:shipping>.php' => 'site/<action>',
                'services/<action:services>.php' => 'site/<action>',
                'services/<action:general>.php' => 'site/<action>',
                'services/<action:groupage>.php' => 'site/<action>',
                'services/<action:mult>.php' => 'site/<action>',
                'services/<action:autocarriage>.php' => 'site/<action>',
                'services/<action:consolidation>.php' => 'site/<action>',
                'services/<action:repacking>.php' => 'site/<action>',

                //delivery
                'delivery/<action:delivery_spare_parts>.php' => 'site/<action>',
                'delivery/<action:delivery_kit>.php' => 'site/<action>',
                'delivery/<action:delivery_furniture>.php' => 'site/<action>',
                'delivery/<action:delivery_toys>.php' => 'site/<action>',
                'delivery/<action:delivery_equipment>.php' => 'site/<action>',

                //pages
                'pages/<action:general_cargo>.html' => 'site/<action>',

                //SEND
                '<action:topostsend>' => 'site/<action>',
                '<action:sendcalc>' => 'site/<action>',

                //LK
                '<action:onhanda>' => 'site/<action>',
                '<action:onhanda>/<n:(.*)>' => 'site/<action>',
                '<action:onhandc>' => 'site/<action>',
                '<action:onhandc>/<n:(.*)>' => 'site/<action>',
                '<action:orders>' => 'site/<action>',

                //GET API
                '<action:getallbytracknum>' => 'site/<action>',
                '<action:getonhandcbytrack>' => 'site/<action>',
                '<action:getgoodsbyoidohc>' => 'site/<action>',
                '<action:getonhandcoid>' => 'site/<action>',
                '<action:getonhandaoid>' => 'site/<action>',
                '<action:getgoodsbyoid>' => 'site/<action>',
                '<action:getallclientorders>' => 'site/<action>',
                '<action:getgoodsbycliorder>' => 'site/<action>',
                '<action:getallonhanda>' => 'site/<action>',
                '<action:getallonhandc>' => 'site/<action>',

                //TEST
                //'<action:onh1>' => 'site/<action>',
                '<action:trackinfo>' => 'site/<action>',
            ],
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
        //'allowedIPs' => ['95.47.180.225', '::1'],
        'allowedIPs'=>['*'],
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
        //'allowedIPs'=>['*'],
    ];
}

return $config;
