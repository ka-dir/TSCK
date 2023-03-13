<?php

/*$app->get('/v1/api_key={key}+id={id}' , 'MainController:index')->setName('main');*/

 $app->get('/', function (Request $request, Response $response) {
     $response->getBody()->write('Hello world!');
    return $response;
 });