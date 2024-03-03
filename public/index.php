<?php
//importa el archivo de helpers
require '../helpers.php'; //funcion del basepath
//como el archivo helpers ya esta importando. se puede llevar
//el importe a sus child como si fuese react prop
// require basePath('views/home.view.php'); //helpers sera enviado a home.view

// loadView("home"); //no se necesita el require porque este es ejecutado dentro de la funcion
// $routes = rotu

//router logic
$uri = $_SERVER['REQUEST_URI'];

//usando enviando $uri al router
require basePath("router.php");
