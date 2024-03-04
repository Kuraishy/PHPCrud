<?php
//imporando db

//importando la configuracion
$config = require basePath('config/db.config.php');
//creando db 
$db = new Database($config);

//getting query
$id = $_GET['id'];
inspect($id);

//fetching listing
$params = ['id' => $id];
$listing = $db->query('SELECT * FROM listings WHERE id=:id', $params)->fetch();


// inspect($listing);
//enviando a view
loadView('listings/show', ['listing' => $listing,]);
