<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
); 

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'ckeditor' => [
            'class' => 'wadeshuler\ckeditor\Module',
        ],
    ],
    'components' => [
        'notifier' => [
            'class' => '\tuyakhov\notifications\Notifier',
            'channels' => [
                'mail' => [
                    'class' => '\tuyakhov\notifications\channels\MailChannel',
                    'from' => 'no-reply@example.com'
                ],
                'sms' => [
                    'class' => '\tuyakhov\notifications\channels\TwilioChannel',
                    'accountSid' => '...',
                    'authToken' => '...',
                    'from' => '+1234567890'
                ],
                'telegram' => [
                     'class' => '\tuyakhov\notifications\channels\TelegramChannel',
                     'botToken' => '...'
                 ],
                'database' => [
                     'class' => '\tuyakhov\notifications\channels\ActiveRecordChannel'
                ]
            ],
        ],
        'response' => [
			'formatters' => [
				'pdf' => [
					'class' => 'robregonm\pdf\PdfResponseFormatter',
				],
			]
		],
        'request' => [
            'csrfParam' => '_csrf-backend', 
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => 'N/A',
        ],
       /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */

    ],
    'params' => $params,
];
