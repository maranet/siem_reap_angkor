<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        // 'cart' => [
        //     'class' => 'devanych\cart\Cart',
        //     'storageClass' => 'devanych\cart\storage\SessionStorage',
        //     'calculatorClass' => 'devanych\cart\calculators\SimpleCalculator',
        //     'params' => [
        //         'key' => 'cart',
        //         'expire' => 604800,
        //         'productClass' => 'app\model\Product',
        //         'productFieldId' => 'id',
        //         'productFieldPrice' => 'price',
        //     ],
        // ],
        'cart' => [
            'class' => 'yz\shoppingcart\ShoppingCart',
            'cartId' => 'my_application_cart',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // 'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                // 'username' => 'admin@example.com',
                'username' => 'siemreapangkoradventure@gmail.com',
                'password' => 'saa@12345',
                'port' => '587',
                'encryption' => 'tls',

            ],             
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptchaConfig',
            'siteKeyV2' => '6LcVV-gUAAAAAOZVUIGNqLTF7-bCVy4zA4ZzCYR1',
            'secretV2' => '6LcVV-gUAAAAAAXWMHBw1-T9HKYw5RM_mM_L09aY',
            // 'siteKeyV3' => 'your siteKey v3',
            // 'secretV3' => 'your secret key v3',
        ],
        'translate' => [
            'class' => 'richweber\google\translate\Translation',
            'key' => 'JP2ernm0BzlouMn6Ch3_GMY9qK2vMCK7dHYeh7SQJPE',
        ],
        'formatter' => [
            'class' => 'yii\i18n\formatter',
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
        ],
    ],
    'params' => $params,
    // // set target language to be Russian
    // 'language' => 'ru-RU',

    // // set source language to be English
    // 'sourceLanguage' => 'en-US',
];
