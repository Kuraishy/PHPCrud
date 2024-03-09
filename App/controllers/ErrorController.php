<?php

//registrando namespace (para autoloader)
namespace App\Controllers;


/**
 * muestra diferentes tipos de errores
 */
class ErrorController
{

    /**
     * Error 404. no se necesita crear el objeto
     *
     * @param string $message
     * @return void
     */
    public static function notFound($message = 'Resource not found')
    {
        //setting response code
        http_response_code(404);
        loadView('error', ['status' => '404', 'message' => $message]);
    }

    /**
     * Error 403 no auth. no se necesita crear el objeto
     *
     * @param string $message
     * @return void
     */
    public static function unauthorized($message = 'not authorized to view this resource')
    {
        //setting response code
        http_response_code(403);
        loadView('error', ['status' => '403', 'message' => $message]);
    }
}
