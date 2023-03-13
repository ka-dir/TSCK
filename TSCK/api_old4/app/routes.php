<?php
// Routes

$app->get('/', App\Controllers\MainController::class)
    ->setName('main0');

//$app->get('/:api_key={key}&id={id}' , 'MainController:index')->setName('main1');
//die('fffffffff');
/*$app->get('/', App\Action\HomeAction::class)
    ->setName('homepage');*/

//$app->get('/v1/api_key={key}+id={id}' ,'MainController:index')->setName('main');

