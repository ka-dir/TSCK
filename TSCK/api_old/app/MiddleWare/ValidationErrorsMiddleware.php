<?php

namespace App\MiddleWare;

/**
 *
 */
class ValidationErrorsMiddleware extends Middleware
{

    public function __invoke($request, $response, $next)
    {
        # code...
        if (isset($_SESSION['errors']))
        {
            $this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);

            unset($_SESSION['errors']);
        }



        $response = $next($request,$response);

        return $response;

    }
}