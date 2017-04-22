<?php
return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/main.php'),
    require(__DIR__ . '/main-local.php'),
    require(YII_APP_BASE_PATH . '/common/config/main.php'),
    require(YII_APP_BASE_PATH . '/common/config/main-local.php'),
    [
        'id' => 'app-admin-tests',
        'components' => [
            'assetManager' => [
                'basePath' => YII_APP_BASE_PATH . '/webs/admin/assets',
            ],
        ],
    ]
);