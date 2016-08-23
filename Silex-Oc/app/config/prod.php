<?php

// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => '127.0.0.1',
    'port'     => '8889',
    'dbname'   => 'weblinks',
    'user'     => 'weblinks_user',
    'password' => 'secret',
);

// define log level
$app['monolog.level'] = 'WARNING';
