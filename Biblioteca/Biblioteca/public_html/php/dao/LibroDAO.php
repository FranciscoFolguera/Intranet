<?php

include_once '../../php/conexion.php';
include_once '../../php/clases/Libro.php';

// http://localhost/GitProyecto/Biblioteca/Biblioteca/public_html/php/dao/LibroDAO.php?listado_prestado=yes
if (isset($_GET['listado_prestado'])) {

    $lista = listar_prestados();
    $vuelta = ['datos' => $lista];
    $objeto = json_encode($vuelta, JSON_UNESCAPED_UNICODE);
    echo $objeto;
}

function listar_prestados() {
    $connection = new conectaBD('biblioteca');
    $rows = array();
    $sql = "SELECT libros.lib_titulo AS 'titulo' ,libros.lib_autor AS' autor' ,libros.lib_isbn AS 'ISBN',
alumnos.al_nombre AS 'nombre alumno', alumnos.al_apellidos AS 'apellido alumno', alumnos.al_curso AS' curso' , alumnos.al_grupo AS 'grupo',
profesores.pro_nombre AS 'nombre profesor', profesores.pro_apellidos AS' apellidos profesor',
libros_prestados.libpre_fechaPrestamo AS 'fecha prestamo', libros_prestados.libpre_observaciones AS 'observaciones'
FROM `libros_prestados`
INNER JOIN `libros`
ON libros_prestados.libpre_libros_id = libros.lib_id
INNER JOIN `alumnos`
ON libros_prestados.libpre_alumnos_id = alumnos.al_id
INNER JOIN `profesores`
ON libros_prestados.libpre_profesores_id = profesores.pro_login";
    $result = $connection->obtenerConex()->query($sql);
    // print_r($result->rowCount());
    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            array_push($rows, $row);
        }
    }


    if (empty($rows)) {
        $rows = 'VACIO';
    }
    return$rows;
}

// http://localhost/GitProyecto/Biblioteca/Biblioteca/public_html/php/dao/LibroDAO.php?listado_disponibles=yes&autor=mo
if (isset($_GET['listado_disponibles'])) {
    $titulo = @$_GET['titulo'];
    $autor = @$_GET['autor'];

    $lista = listar_disponibles($titulo, $autor);
    // $vuelta = ['datos' => $lista];
//    $objeto = json_encode($vuelta, JSON_UNESCAPED_UNICODE);
//    echo $objeto;


    $clase_temp = new stdClass();
    $clase_temp->datos = $lista;
    //  print_r($asdasd);
    $objeto = json_encode($clase_temp, JSON_UNESCAPED_UNICODE);
    //print_r($objeto);
    echo $objeto;
}

function listar_disponibles($titulo, $autor) {
    $connection = new conectaBD('biblioteca');
    $rows = array();
    $sql = "SELECT lib_titulo AS 'Título', lib_autor AS 'Autor',lib_saga AS 'Saga', lib_categoria AS 'Categoría'"
            . ",lib_fechaPubli AS 'Fecha Publicación',lib_editorial AS 'Editorial',lib_edicion AS 'Edición'"
            . ",lib_otros AS 'Otros' "
            . " FROM `libros` WHERE lib_prestado=0";
    if (!empty($titulo)) {
        $sql = $sql . " AND lib_titulo LIKE :titulo  ";
        $titulo = '%' . $titulo . '%';
    }
    if (!empty($autor)) {

        $sql = $sql . ' AND lib_autor LIKE  :autor  ';
        $autor = '%' . $autor . '%';
    }
    $q = $connection->obtenerConex()->prepare($sql);
    if (!empty($autor)) {

        $q->bindValue(':autor', $autor, PDO::PARAM_STR);
    }
    if (!empty($titulo)) {

        $q->bindValue(':titulo', $titulo, PDO::PARAM_STR);
    }
    $q->execute();
    $rows = $q->fetchAll(PDO::FETCH_ASSOC);

    if (empty($rows)) {
        $rows = 'VACIO';
    }
    return $rows;
}

// http://localhost/GitProyecto/Biblioteca/Biblioteca/public_html/php/dao/LibroDAO.php?busqueda_libros=yes&autor=mo
if (isset($_GET['busqueda_libros'])) {
    $titulo = @$_GET['titulo'];
    $autor = @$_GET['autor'];

    $lista = busqueda_libros($titulo, $autor);
    $vuelta = ['datos' => $lista];

    $objeto = json_encode($vuelta, JSON_UNESCAPED_UNICODE);
    echo $objeto;
}

function busqueda_libros($titulo, $autor) {
    $connection = new conectaBD('biblioteca');
    $rows = array();
    $sql = "SELECT lib_titulo AS 'Título', lib_autor AS 'Autor',lib_saga AS 'Saga', lib_categoria AS 'Categoría'"
            . ",lib_fechaPubli AS 'Fecha Publicación',lib_editorial AS 'Editorial',lib_edicion AS 'Edición'"
            . ",lib_otros AS 'Otros' , lib_prestado AS 'Estado'"
            . " FROM `libros` WHERE 1=1 ";
    if (!empty($titulo)) {
        $sql = $sql . " AND lib_titulo LIKE :titulo  ";
        $titulo = '%' . $titulo . '%';
    }
    if (!empty($autor)) {

        $sql = $sql . ' AND lib_autor LIKE  :autor  ';
        $autor = '%' . $autor . '%';
    }
    
    if (!empty($idABIES)) {
        $sql = $sql . " AND lib_idAbies LIKE :idAbies  ";
        $idABIES = '%' . $idABIES . '%';
    }
    if (!empty($ISBN)) {

        $sql = $sql . ' AND lib_isbn LIKE  :isbn  ';
        $ISBN = '%' . $ISBN . '%';
    }
    $q = $connection->obtenerConex()->prepare($sql);
    if (!empty($autor)) {

        $q->bindValue(':autor', $autor, PDO::PARAM_STR);
    }
    if (!empty($titulo)) {

        $q->bindValue(':titulo', $titulo, PDO::PARAM_STR);
    }
    
    if (!empty($idABIES)) {

        $q->bindValue(':idAbies', $idABIES, PDO::PARAM_STR);
    }
    if (!empty($ISBN)) {

        $q->bindValue(':isbn', $ISBN, PDO::PARAM_STR);
    }
    // echo $sql;
    $q->execute();
    $rows = $q->fetchAll(PDO::FETCH_ASSOC);


    if (empty($rows)) {
        $rows = 'VACIO';
    } return$rows;
}

if (isset($_GET['insert_libro'])) {

    if (empty(@$_GET['idAbies'])) {
        $idAbies = '';
    } else {
        $idAbies = @$_GET['idAbies'];
    }
         $isbn = @$_GET['isbn'];
    $titulo = @$_GET['titulo'];
    if (empty(@$_GET['autor'])) {
        $autor = '';
    } else {
        $autor = @$_GET['autor'];
    }
    if (empty(@$_GET['saga'])) {
        $saga = '';
    } else {
        $saga = @$_GET['saga'];
    }
    $categoria = @$_GET['categoria'];
    if (empty(@$_GET['fechaPubli'])) {
        $fechaPubli = '';
    } else {
        $fechaPubli = @$_GET['fechaPubli'];
    }
    $editorial = @$_GET['editorial'];
    if (empty(@$_GET['edicion'])) {
        $edicion = '';
    } else {
        $edicion = @$_GET['edicion'];
    }
    $otros = @$_GET['otros'];

    $resultado = insert($idAbies, $isbn, $titulo, $autor, $saga, $categoria, $fechaPubli, $editorial, $edicion, $otros);
    $vuelta = ['datos' => $resultado];

    $objeto = json_encode($vuelta, JSON_UNESCAPED_UNICODE);
    echo $objeto;
}

function insert($idAbies, $isbn, $titulo, $autor, $saga, $categoria, $fechaPubli, $editorial, $edicion, $otros) {
    $connection = new conectaBD('biblioteca');
    $datos = array(':par1' => $idAbies, ':par2' => $isbn, ':par3' => $titulo, ':par4' => $autor, ':par5' => $saga, ':par6' => $categoria, ':par7' => $fechaPubli, ':par8' => $editorial, ':par9' => $edicion, ':par10' => $otros);
    $sql = 'INSERT INTO `libros`(`lib_idAbies`, `lib_isbn`, `lib_titulo`, `lib_autor`, `lib_saga`, `lib_categoria`, `lib_fechaPubli`, `lib_editorial`, `lib_edicion`,  `lib_prestado`, `lib_otros`) '
            . 'VALUES (:par1,:par2,:par3,:par4,:par5,:par6,:par7,:par8,:par9,0,:par10)';

    $q = $connection->obtenerConex()->prepare($sql);


    $realizado = $q->execute($datos);
    $intResultado = ($realizado) ? $q->rowCount() : 0;

    return $intResultado;
}
