<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';



$app = new \Slim\App([

    'settings' => [

        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'services',
            'username' => 'root',
            'password' => '12345_Six',
            'charser' => 'utf8',
            'collation' => 'utf8_encode_ci',
            'prefix' => '',
        ]

    ],


]);

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;

$capsule->addConnection($container['settings']['db']);

$capsule->setAsGlobal();

$capsule->bootEloquent();


$container['environment'] = function () {
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $_SERVER['SCRIPT_NAME'] = dirname(dirname($scriptName)) . '/' . basename($scriptName);
    return new Slim\Http\Environment($_SERVER);
};

$container['db'] = function ($container) use ($capsule)
{
    return $capsule;
};


$container['validator'] = function ($container)
{
    return new App\Validation\Validator;
};


$container['HomeController'] = function($container)
{
    return new \App\Controllers\HomeController($container);
};

$container['AuthController'] = function($container)
{
    return new \App\Controllers\AuthController($container);
};

$container['MainController'] = function($container)
{
    return new \App\Controllers\MainController($container);
};



$app->add(new \App\MiddleWare\ValidationErrorsMiddleware($container));


require __DIR__ . '/../app/routes.php';