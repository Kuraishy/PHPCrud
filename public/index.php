<?php

session_start();

//using composer 
require __DIR__ . '/../vendor/autoload.php';

//importa el archivo de helpers
require '../helpers.php'; //funcion del basepath
//como el archivo helpers ya esta importando. se puede llevar
//el importe a sus child como si fuese react prop
// require basePath('views/home.view.php'); //helpers sera enviado a home.view

//importando framwrodk router
use Framework\Router;

// loadView("home"); //no se necesita el require porque este es ejecutado dentro de la funcion
// $routes = rotu
//------importando ------------
// require basePath('Framework/Database.php');
// require basePath('Framework/Router.php');
//-----AUTO LOADER---------------------
// spl_autoload_register(function ($class) {
//     //maping file to a name
//     $path = basePath('Framework/' . $class . '.php');
//     if (file_exists($path)) {
//         require($path);
//     }
// });


//-------DB-------------------
//impoertando DB
// require basePath('Database.php');
// //importando Database config
// $dbConfig = require basePath('config/db.config.php');
// //importando Database class
// // require basePath('Database.php');

// $db = new Database($dbConfig);


//------ROUTER-------------
//instantiating router
$router = new Router();
//importando las rutas
$routes = require basePath('routes.php');
//obtencion de uri y request sin incluir el query
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// $method = $_SERVER['REQUEST_METHOD'];
//pasando checando si existe el uri y metodo
$router->route($uri);//, $method);
