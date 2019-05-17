function validaInsertLibro() {
    var valido = true;
    var isbn = document.getElementById("inputISBN").value;
    if (expreISBN(isbn) === false || isbn.length < 2) {
        valido = false;
        var div = document.getElementById("inputISBNHelp");
        var err = "(*) Formato no valido";
        crearMensajeError(div, err);
    } else {
        document.getElementById("inputISBN").style.backgroundColor = "#7CFC00";
    }
    var titulo = document.getElementById("inputTitulo").value;
    if (expreTitulo(titulo) === false) {
        valido = false;
        var div = document.getElementById("inputTituloHelp");
        var err = "(*) Formato no valido: nºs, letras y espacios";
        crearMensajeError(div, err);
    } else {
        document.getElementById("inputTitulo").style.backgroundColor = "#7CFC00";

    }

    var categoria = document.getElementById("inputCategoria").value;
    if (expreTitulo(categoria) === false) {
        valido = false;
        var div = document.getElementById("inputCategoriaHelp");
        var err = "(*) Formato no valido: nºs, letras y espacios";
        crearMensajeError(div, err);
    } else {
        document.getElementById("inputCategoria").style.backgroundColor = "#7CFC00";

    }

    var editorial = document.getElementById("inputEditorial").value;
    if (expreTitulo(editorial) === false) {
        editorial = false;
        var div = document.getElementById("inputEditorialHelp");
        var err = "(*) Formato no valido: nºs, letras y espacios";
        crearMensajeError(div, err);
    } else {
        document.getElementById("inputEditorial").style.backgroundColor = "#7CFC00";

    }
    if (valido === true) {
insertLibro();
    } else {
alert('Revisa los campos');
    }
}
function insertLibro() {
    var url = "../php/dao/LibroDAO.php?";
    
    var idAbies = document.getElementById("inputIDAbies").value;
    var isbn = document.getElementById("inputISBN").value;
    var titulo = document.getElementById("inputTitulo").value;
    var autor = document.getElementById("inputAutor").value;
    var saga = document.getElementById("inputSaga").value;
        var categoria = document.getElementById("inputCategoria").value;
    var fecha = document.getElementById("inputFechaPubli").value;
    var editorial = document.getElementById("inputEditorial").value;
    var edicion = document.getElementById("inputEdicion").value;
    var otros = document.getElementById("inputOtros").value;

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        data: {insert_libro: 'yes',idAbies:idAbies,isbn:isbn,titulo:titulo,autor:autor,saga:saga,categoria:categoria,fechaPubli:fecha,editorial:editorial,edicion:edicion,otros:otros},
        async: false,
        success: function (data) {
            // var div = document.getElementById("errLogin");
            console.log(data);

            if (data.datos == 'ERROR_CONEX') {
                var err = "Ha habido un problema con el servidor, contacte con el administrador";
                //mostrarErr(div, err);
            } else if (data.datos == '1') {
                // nO HAY LIBROS EN PRESTAMO
                alert( "Se ha añadido el libro con exito");
                document.getElementsByTagName("form").reset();
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
function expreISBN(isbn) {

    var expreg = /^[0-9 -]*$/g;
    var valido = false;
    if (expreg.test(isbn)) {

        valido = true;
    }

    return valido;
}

function expreTitulo(titulo) {

    var expreg = /^[a-zA-Z]+[ a-zA-Z0-9]*$/g;
    var valido = false;
    if (expreg.test(titulo)) {

        valido = true;
    }

    return valido;
}
function crearMensajeError(div, text) {
    div.innerHTML = text;
    div.style.color = "#ff0000";
}