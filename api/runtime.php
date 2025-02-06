<?php
$bootstrap = dirname(__DIR__) . '/vendor/autoload.php';

if (!file_exists($bootstrap)) {
    die('Please run "composer install" first');
}

require $bootstrap;

$app = require_once dirname(__DIR__) . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();
$kernel->terminate($request, $response);