<?php

class Alumno{
    
    private $al_nombre;
    private $al_apellidos;
    private $al_curso;
    private $al_grupo;
    private $al_nivel;
    
    function __construct($al_nombre=null, $al_apellidos=null, $al_curso=null, $al_grupo=null, $al_nivel=null) {
        $this->al_nombre = $al_nombre;
        $this->al_apellidos = $al_apellidos;
        $this->al_curso = $al_curso;
        $this->al_grupo = $al_grupo;
        $this->al_nivel = $al_nivel;
    }
    function getAl_nombre() {
        return $this->al_nombre;
    }

    function getAl_apellidos() {
        return $this->al_apellidos;
    }

    function getAl_curso() {
        return $this->al_curso;
    }

    function getAl_grupo() {
        return $this->al_grupo;
    }

    function getAl_nivel() {
        return $this->al_nivel;
    }

    function setAl_nombre($al_nombre) {
        $this->al_nombre = $al_nombre;
    }

    function setAl_apellidos($al_apellidos) {
        $this->al_apellidos = $al_apellidos;
    }

    function setAl_curso($al_curso) {
        $this->al_curso = $al_curso;
    }

    function setAl_grupo($al_grupo) {
        $this->al_grupo = $al_grupo;
    }

    function setAl_nivel($al_nivel) {
        $this->al_nivel = $al_nivel;
    }


}