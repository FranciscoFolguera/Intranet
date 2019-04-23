<?php

include_once '../../php/conexion.php';
include_once '../../php/clases/Profesor.php';
include_once '../../php/funciones.php';

//http://localhost/GitProyecto/Biblioteca/Biblioteca/public_html/php/dao/ProfesorDAO.php?log_nick=franfolguera&log_password=123
if (isset($_GET['log_password']) && isset($_GET['log_nick'])) {


    $nick = filtrado($_GET['log_nick']);
    $password = filtrado($_GET['log_password']);
    
   
    $lista = login($nick);
     $vuelta = ['datos' => $lista];

    $objeto = json_encode($vuelta);
    echo $objeto;
}

function login($nick) {

    
    
            $connection = new conectaBD('biblioteca');
          
       
    $rows = array();



    $datos = array(':par1' => $nick);
    $sql = ' SELECT * FROM profesor WHERE pro_login=:par1';
    $q = $connection->obtenerConex()->prepare($sql);
    $q->execute($datos);

    $q->setFetchMode();
    $rows = $q->fetchAll();

    if (empty($rows)) {
        $rows = 'VACIO';

        return$rows;
    } else {
        return $rows[0];
    }
}
