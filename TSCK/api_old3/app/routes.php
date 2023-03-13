<?php

$app->get('/v1/api_key={key}+id={id}' , 'MainController:index')->setName('main');