<?php

//registrando namespace (para autoloader)
namespace App\Controllers;
//importando DB
use Framework\Database;

class ListingController
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
        $listing = $this->db->query("SELECT * FROM listings")->fetchAll(); //gegting all

        //cargando view y enviando informacion
        loadView('/listings/index', ['listings' => $listing,]);

        // die('homeControler@index');
    }
    public function create()
    {
        loadView("listings/create");
    }
    public function show()
    {

        $id = $_GET['id'] ?? '';
        $params = [
            'id' => $id
        ];
        //llamando a db
        $listing = $this->db->query("SELECT * FROM listings WHERE id=:id", $params)->fetch();
        loadView('listings/show', ['listing' => $listing]);
    }
}
