<?php



//associando metodos con ruitas y controladores
// $router->get('/', 'controllers/home.php');
//refactor
$router->get('/', 'HomeController@index');



// $router->get('/listings', 'controllers/listings/index.php');
// $router->get('/listings/create', 'controllers/listings/create.php');
// $router->get('/listing', 'controllers/listings/show.php');
