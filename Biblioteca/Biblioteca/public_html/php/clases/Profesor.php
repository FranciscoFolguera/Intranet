<?php

class Profesor{
    
    private $pro_nombre;
    private $pro_apellidos;
    
    function __construct($pro_nombre=null, $pro_apellidos=null) {
        $this->pro_nombre = $pro_nombre;
        $this->pro_apellidos = $pro_apellidos;
    }
    function getPro_nombre() {
        return $this->pro_nombre;
    }

    function getPro_apellidos() {
        return $this->pro_apellidos;
    }

    function setPro_nombre($pro_nombre) {
        $this->pro_nombre = $pro_nombre;
    }

    function setPro_apellidos($pro_apellidos) {
        $this->pro_apellidos = $pro_apellidos;
    }


}