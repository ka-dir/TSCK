<?php


namespace App\MiddleWare;

/**
 *
 */
class Middleware
{
    protected $container;

    public function __construct($container)
    {
        # code...

        $this->container = $container;
    }
}