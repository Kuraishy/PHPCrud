<?php

//registrando namespace (para autoloader)
namespace App\Controllers;
//importando DB
use Framework\Database;
use Framework\Validation;

class ListingController
{
    protected $db;

    /**
     * Construccion del listcontroller1
     */
    public function __construct()
    {
        //importando la configuracion
        $config = require basePath('config/db.config.php');
        // //creando db 
        $this->db = new Database($config);
        // die('homeController');
    }

    /**
     * Home
     *
     * @return void
     */
    public function index()
    {
        $listing = $this->db->query("SELECT * FROM listings")->fetchAll(); //gegting all

        //cargando view y enviando informacion
        loadView('/listings/index', ['listings' => $listing,]);

        // die('homeControler@index');
    }

    /**
     * Cargar el formulario para crear un nuevo trabajo
     *
     * @return void
     */
    public function create()
    {
        loadView("listings/create");
    }

    /**
     * Muestra un trabajo especifico
     *
     * @return void
     */
    public function show($params)
    {

        $id = $params['id'] ?? '';
        // $id = $_GET['id'] ?? '';
        $params = [
            'id' => $id
        ];
        //llamando a db
        $listing = $this->db->query("SELECT * FROM listings WHERE id=:id", $params)->fetch();

        //checando si existe el id enviado
        if (!$listing) {
            ErrorController::notFound("listing not found");
            return;
        }
        loadView('listings/show', ['listing' => $listing]);
    }


    /**
     * delete a listing
     *
     * @param array $params
     * @return void
     */
    public function destroy($params)
    {
        //getting id from url
        $id = $params['id'];
        $params = [
            'id' => $id,
        ];

        $listing = $this->db->query('SELECT * FROM listings WHERE id=:id', $params)->fetch();

        //if listing doesnt exists
        if (!$listing) {
            ErrorController::notFound("listing not fouend");
            return;
        }

        //there is a listing, delete it
        // inspectAndDie($listing);
        $this->db->query('DELETE FROM listings WHERE id=:id', $params);

        //using session. flash message
        $_SESSION['success_message'] = 'Listings deleted successfully';
        // echo $_SESSION;
        // ech $_SESSION['success_message'];
        redirect("/listings");
    }

    /**
     * Store data in database
     * 
     * @return void
     */
    public function store()
    {
        //seguridad, solo acepta estos fields
        $allowedFields = ['title', 'description', 'salary', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits'];




        //checando elementos 
        $newListingData = array_intersect_key(
            $_POST,
            array_flip($allowedFields)
        ); //making values =>keys

        //llama a la funcion sanitize (tiene que tener el mismo nombre)
        $newListingData = array_map('sanitize', $newListingData);
        //hard coding user id
        $newListingData['user_id'] = 1;
        // especificando que fields son not NULL
        $requiredFields = ['title', 'description', 'email', 'city', 'state'];

        $errors = []; //para mostrar errores
        //checando si los datos queridos estan llenos
        foreach ($requiredFields as $field) {
            //validando la si lo recibido tiene el field requerido y si tiene el tamano adecuado
            $val = Validation::string($newListingData[$field]);
            //si el field esta vacio o no es valido, enviar un error
            if (empty($newListingData[$field]) || !$val) {
                $errors[$field] = ucfirst($field) . ' is required';
            }
        }
        //todo ok
        if (!empty($errors)) {
            //reload view with errors
            loadView('listings/create', ['errors' => $errors, 'listingData' => $newListingData]);
        } else {
            // todo ok
            //submit data
            // $this->db->query('INSERT INTO listings (title,description,salary,tags,company,address,city,state,phone,email,requirements,benefits,user_id) VALUES (:title, :description, :salary, :tags, :company, :address, :city, :state, :phone, :email, :requirements, :benefits, :user_id)', $newListingData);

            $fields = [];

            //guardando los keys en un array
            foreach ($newListingData as $field => $value) {
                $fields[] = $field;
            }
            //obteniendo los keys a string
            $fields = implode(", ", $fields);
            // inspect($fields);
            //obteniendo los valores
            $values = [];
            foreach ($newListingData as $field => $value) {
                //convert empty string to null
                if ($value == '') {
                    $newListingData[$field] = null;
                }
                $values[] = ":" . $field;
            }
            //juntado a sting
            $values = implode(", ", $values);

            //creando el query
            $query = "INSERT INTO listings ({$fields}) VALUES ({$values})";
            // inspectAndDie($query);
            //insetando solo los datos que tenemos disponibles
            $this->db->query($query, $newListingData);



            redirect('/listings');
        }


        // inspectAndDie($errors);
    }
}
