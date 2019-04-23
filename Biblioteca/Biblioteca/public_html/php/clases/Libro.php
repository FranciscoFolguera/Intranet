<?php

class Libro{
    
    private $lib_id;
    private $lib_titulo;
    private $lib_prestado;
    private $lib_isbn;
    private $lib_prestador;
    private $lib_receptor;
    private $lib_fechaPrestamo;
    private $lib_autor;
    private $lib_edicion;
    private $lib_editorial;
    
    function __construct($lib_id=null, $lib_titulo=null, $lib_prestado=null, $lib_isbn=null, $lib_prestador=null, $lib_receptor=null, $lib_fechaPrestamo=null, $lib_autor=null, $lib_edicion=null, $lib_editorial=null) {
        $this->lib_id = $lib_id;
        $this->lib_titulo = $lib_titulo;
        $this->lib_prestado = $lib_prestado;
        $this->lib_isbn = $lib_isbn;
        $this->lib_prestador = $lib_prestador;
        $this->lib_receptor = $lib_receptor;
        $this->lib_fechaPrestamo = $lib_fechaPrestamo;
        $this->lib_autor = $lib_autor;
        $this->lib_edicion = $lib_edicion;
        $this->lib_editorial = $lib_editorial;
    }
    function getLib_id() {
        return $this->lib_id;
    }

    function getLib_titulo() {
        return $this->lib_titulo;
    }

    function getLib_prestado() {
        return $this->lib_prestado;
    }

    function getLib_isbn() {
        return $this->lib_isbn;
    }

    function getLib_prestador() {
        return $this->lib_prestador;
    }

    function getLib_receptor() {
        return $this->lib_receptor;
    }

    function getLib_fechaPrestamo() {
        return $this->lib_fechaPrestamo;
    }

    function getLib_autor() {
        return $this->lib_autor;
    }

    function getLib_edicion() {
        return $this->lib_edicion;
    }

    function getLib_editorial() {
        return $this->lib_editorial;
    }

    function setLib_id($lib_id) {
        $this->lib_id = $lib_id;
    }

    function setLib_titulo($lib_titulo) {
        $this->lib_titulo = $lib_titulo;
    }

    function setLib_prestado($lib_prestado) {
        $this->lib_prestado = $lib_prestado;
    }

    function setLib_isbn($lib_isbn) {
        $this->lib_isbn = $lib_isbn;
    }

    function setLib_prestador($lib_prestador) {
        $this->lib_prestador = $lib_prestador;
    }

    function setLib_receptor($lib_receptor) {
        $this->lib_receptor = $lib_receptor;
    }

    function setLib_fechaPrestamo($lib_fechaPrestamo) {
        $this->lib_fechaPrestamo = $lib_fechaPrestamo;
    }

    function setLib_autor($lib_autor) {
        $this->lib_autor = $lib_autor;
    }

    function setLib_edicion($lib_edicion) {
        $this->lib_edicion = $lib_edicion;
    }

    function setLib_editorial($lib_editorial) {
        $this->lib_editorial = $lib_editorial;
    }


}