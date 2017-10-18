<?php

return [
    'id' => 'yii2-test-console',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@yuncms/admin' => dirname(dirname(dirname(__DIR__))),
        '@tests' => dirname(dirname(__DIR__)),
    ],
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            //命名空间
            'migrationNamespaces' => [
                'yuncms\admin\migrations',
            ],
            // 完全禁用非命名空间迁移
            'migrationPath' => null,
        ],
    ],
    'components' => [
        'log' => null,
        'cache' => null,
        'user' => [
            'identityClass' => 'yuncms\admin\models\Admin'
        ],
        'i18n' => [
            'translations' => [
                'admin*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'db' => require __DIR__ . '/db.php',
    ],
];
