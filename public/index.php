<?php
//importa el archivo de helpers
require '../helpers.php'; //funcion del basepath
//como el archivo helpers ya esta importando. se puede llevar
//el importe a sus child como si fuese react prop
// require basePath('views/home.view.php'); //helpers sera enviado a home.view

// loadView("home"); //no se necesita el require porque este es ejecutado dentro de la funcion
// $routes = rotu



//importando router class
require basePath('Router.php');
$router = new Router();
//importando las rutas
$routes = require basePath('routes.php');
//obtencion de uri y request
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
//pasando checando si existe el uri y metodo
$router->route($uri, $method);
