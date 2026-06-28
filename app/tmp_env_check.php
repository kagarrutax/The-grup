<?php

require __DIR__ . '/vendor/autoload.php';
define('LARAVEL_START', microtime(true));
$app = require __DIR__ . '/bootstrap/app.php';
echo 'APP_KEY=' . env('APP_KEY') . PHP_EOL;
echo 'CONFIG_APP_KEY=' . $app->make('config')->get('app.key') . PHP_EOL;
