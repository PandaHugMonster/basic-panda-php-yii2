<?php

use function spaf\simputils\basic\env;

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=db;dbname=app',
    'username' => env("DB_USER"),
    'password' => env("DB_PASSWORD"),
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
