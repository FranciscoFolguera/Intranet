function listar_prestados() {
    //--- Listamos los libros que están en prestamo ---\\

    var url = "../php/dao/LibroDAO.php?";
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        data: {listado_prestado: 'yes'},
        async: false,
        success: function (data) {
            // var div = document.getElementById("errLogin");
            console.log(data);

            if (data.datos == 'ERROR_CONEX') {
                var err = "Ha habido un problema con el servidor, contacte con el administrador";
                //mostrarErr(div, err);
            } else if (data.datos == 'VACIO') {
                // nO HAY LIBROS EN PRESTAMO
                var err = "Ese nombre no correponde a nigún usuario";
                // mostrarErr(div, err);
            } else if (data.datos.length > 0) {
                crear_tabla(data, 'PRESTAMO');
            } else {
                var err = "Error, contacta con el administrador";
                // mostrarErr(div, err);
            }





        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log(xhr.responseText);
        }
    });

}

function busqueda_libros() {
    //--- Listamos los libros que están en prestamo ---\\
    var url = "../php/dao/LibroDAO.php?";
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        data: {busqueda_libros: 'yes'},
        async: false,
        success: function (data) {
            // var div = document.getElementById("errLogin");
            console.log(data);

            if (data.datos == 'ERROR_CONEX') {
                var err = "Ha habido un problema con el servidor, contacte con el administrador";
                //mostrarErr(div, err);
            } else if (data.datos == 'VACIO') {
                // nO HAY LIBROS EN PRESTAMO
                var err = "Ese nombre no correponde a nigún usuario";
                // mostrarErr(div, err);
            } else if (data.datos.length > 0) {
                crear_tabla_prestados(data, 'BUSQUEDA');
            } else {
                var err = "Error, contacta con el administrador";
                // mostrarErr(div, err);
            }
       },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log(xhr.responseText);
        }
    });

}
function listar_disponibles() {
    //--- Listamos los libros que están en prestamo ---\\
alert('Listamos los disponibles');
    var url = "../php/dao/LibroDAO.php?";
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        data: {listar_disponibles: 'yes'},
        async: false,
        success: function (data) {
        console.log(data);
            if (data.datos == 'ERROR_CONEX') {
                var err = "Ha habido un problema con el servidor, contacte con el administrador";
                //mostrarErr(div, err);
            } else if (data.datos == 'VACIO') {
                // nO HAY LIBROS EN PRESTAMO
                var err = "Ese nombre no correponde a nigún usuario";
                // mostrarErr(div, err);
            } else if (data.datos.length > 0) {
                crear_tabla_prestados(data, 'BUSQUEDA');
            } else {
                var err = "Error, contacta con el administrador";
                // mostrarErr(div, err);
            }





        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log(xhr.responseText);
            console.log(ajaxOptions);
        }
    });

}

function crear_tabla_prestados(lista, utilidad) {
    var body = document.getElementsByTagName('body')[0];
    var tbl = document.createElement('table');
    tbl.style.width = '100%';
    tbl.setAttribute('border', '1');
    var tbdy = document.createElement('tbody');
    var thead = document.createElement('thead');

    var tr = document.createElement('tr');


    for (var clave in lista.datos[0]) {
        var th = document.createElement('th');
        th.appendChild(document.createTextNode(clave));
        tr.appendChild(th);

    }
    thead.appendChild(tr);
    for (var i = 0; i < lista.datos.length; i++) {
        var tr = document.createElement('tr');

        for (var clave in lista.datos[i]) {
            var td = document.createElement('td');
            if (lista.datos[i][clave] === null) {
                td.appendChild(document.createTextNode(''));
            } else {
                if (clave === 'Estado') {
                    var estado = lista.datos[i][clave];
                    if (estado == 0) {
                        td.appendChild(document.createTextNode("Disponible"));
                    } else {
                        td.appendChild(document.createTextNode("Prestado"));
                    }

                } else {
                    td.appendChild(document.createTextNode(lista.datos[i][clave]));

                }


            }



            tr.appendChild(td);

        }
        if (utilidad === 'BUSQUEDA' && estado == 1) {
            tr.style.backgroundColor = "#ff9900";
        }

        tbdy.appendChild(tr);
    }
    tbl.appendChild(thead);

    tbl.appendChild(tbdy);
    body.appendChild(tbl);

}
