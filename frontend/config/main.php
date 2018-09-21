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
    'bootstrap' => [
        'log'   //это значит, что он загружается до запуска самого приложения. Что позволяет,
                //в случае если приложение не запустилось или запустилось с ошибками,
                //просматривать служебные сообщения (логи) с соответствующими ошибками/предупреждениями.
    ],
    'language' => 'ru',
    'controllerNamespace' => 'frontend\controllers',
	'homeUrl' => '/',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
			'baseUrl' => '',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
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
            'flushInterval' => 100,
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'categories' => ['userLoginSuccess'],
                    'logFile' => '@runtime/logs/login.log',
                    'logVars' => [],
                    'maxLogFiles' => 5
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                    'categories' => ['userLoginError'],
                    'logFile' => '@runtime/logs/loginError.log',
                    'logVars' => [],
                    'prefix' => function($message){
                        return "[incorrect-password]";
                    },
                    'maxLogFiles' => 5
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'controller' => [
                        'api\project',
                        'api\user',
                    ]
                ],
                '<controller:(user|project|task)>/<id:\d+>' => '<controller>/view',
                '<controller:(user|project|task)>/<action:[\w-]+>/<id:\d+>' => '<controller>/<action>/',
                '<controller:(user|project|task)>s' => '<controller>/index',
            ],
        ],
    ],
    'modules' => [
        'api' => [
            'class' => 'frontend\modules\api\Rest',
        ]
    ],
    'params' => $params,
];
