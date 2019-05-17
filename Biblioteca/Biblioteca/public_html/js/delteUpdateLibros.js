document.addEventListener("readystatechange", cargarEventos, false);

function cargarEventos() {
    //alert(document.readyState);
    if (document.readyState === "complete") {

        document.getElementById("img_buscar").addEventListener("click", busqueda_libros);

    }

}
   function busqueda_libros() {
    //--- Listamos los libros que están en prestamo ---\\
    var url = "../php/dao/LibroDAO.php?";
 var idAbies = document.getElementById("inputIDAbiesBusqueda").value;
    var isbn = document.getElementById("inputISBNBusqueda").value;
    var titulo = document.getElementById("inputTituloBusqueda").value;
    var autor = document.getElementById("inputAutorBusqueda").value;
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
