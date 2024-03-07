<?php

//registrando namespace (para autoloader)
namespace App\Controllers;
//importando DB
use Framework\Database;

class HomeController
{
    protected $db;
    public function __construct()
    {
        //importando la configuracion
        $config = require basePath('config/db.config.php');
        // //creando db 
        $this->db = new Database($config);
        // die('homeController');
    }

    public function index()
    {
        $listing = $this->db->query("SELECT * FROM listings LIMIT 6")->fetchAll(); //gegting all

        //cargando view y enviando informacion
        loadView('home', ['listings' => $listing,]);

        // die('homeControler@index');
    }
}
