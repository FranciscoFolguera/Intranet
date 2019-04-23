<?php
function test_nombre($nombre) {
    $expresion = '/^[a-zA-Z0-9 ]{2,}$/';
    //$expresion = '/(?=.*[a-zA-Z0-9])|((?=.*[a-zA-Z0-9])-(?=.*[a-zA-Z0-9]))|((?=.*[a-zA-Z0-9])-(?=.*[a-zA-Z0-9]))/';
    if (preg_match($expresion, $nombre)) {
        return true;
    }
    return false;
}

function filtrado($datos) {
    $datos = trim($datos);
    $datos = stripslashes($datos);
    $datos = htmlspecialchars($datos);
    return $datos;
}