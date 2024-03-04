<?php

//importando la configuracion
$config = require basePath('config/db.config.php');
//creando db 
$db = new Database($config);
//fetchin
$listing = $db->query("SELECT * FROM listings LIMIT 6")->fetchAll(); //gegting all
// inspect($listing);
//cargando view y enviando informacion
loadView('home', ['listings' => $listing,]);
