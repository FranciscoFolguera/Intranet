<?php

class conectaBD {

    private $conn = null;

    public function __construct($database = '') {
        $dsn = "mysql:host=localhost;dbname=$database;charset=UTF8";
        try {
            $this->conn = new PDO($dsn, 'root', '1234');
        } catch (PDOException $ex) {
//             $vuelta = ['datos' => "ERROR"];
            $vuelta = ['datos' => "ERROR_CONEX"];

            $objeto = json_encode($vuelta);
            echo $objeto;
            die;
        }
    }

    public function __destruct() {
        $this->conn = null;
    }

    public function consulta($select) {
        try {
            $query = $this->conn->query($select);
            $rows = array();
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $rows = $query->fetchAll();

            return $rows;
        } catch (Exception $ex) {
            echo"todo mal";
            echo("error al ejecutar la orden: " . $ex->getMessage());
        }
    }

    public function obtenerConex() {
        return $this->conn;
    }

}
