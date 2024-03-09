<?php

namespace Framework;

use PDO;

class Database
{
    public $conn;

    /**
     * constructor for DB class
     * (dsn,)
     * @param map $config
     */
    public function __construct($config)
    {

        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";

        //connection options
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            //no numeric index
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        ];

        //trying connection
        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
            // echo "connected";
        } catch (PDOException $e) {
            // phpinfo();
            throw new Exception("Connexion fallida: {$e->getMessage()}");
        }
    }

    /**
     * Query to the database
     *
     * @param string $query
     * @return PDOStatement
     * @throws PDOException
     */
    public function query($query, $params = [])
    {
        try {
            //creating statemnet
            $stmt = $this->conn->prepare($query);
            //bind named params (limpiando el input)
            foreach ($params as $param => $value) {
                //para pasar parametros al stmt (id=$id) como en go
                $stmt->bindValue(':' . $param, $value); //(:id,$id)
            }
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("query failed to execute {$e->getMessage()}");
        }
    }
}
