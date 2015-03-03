<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'homeUrl' => '/admin',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'category' => [
            'class' => 'backend\modules\category\Category',
        ],
        'software' => [
            'class' => 'backend\modules\software\Software',
        ],
        'manufacturer' => [
            'class' => 'backend\modules\manufacturer\Manufacturer',
        ],
    ],
    'components' => [
        'request' => [
            'baseUrl' => '/admin',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'authTimeout' => 5,
            'enableAutoLogin' => false,
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
        'user' => [
            'identityClass' => 'common\models\User', // User must implement the IdentityInterface
            'enableAutoLogin' => true,
        ],
        'imageCache' => [
            'class' => 'iutbay\yii2imagecache\ImageCache',
            'sourcePath' => '@app/web/images',
            'sourceUrl' => '@web/images',
            //'thumbsPath' => '@app/web/thumbs',
            //'thumbsUrl' => '@web/thumbs',
            //'sizes' => [
            //    'thumb' => [150, 150],
            //    'medium' => [300, 300],
            //    'large' => [600, 600],
            //],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'thumbs/<path:.*>' => 'site/thumb',
            ],
        ],
    ],
    'params' => $params,
];
