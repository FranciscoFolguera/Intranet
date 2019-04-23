
function redireccionaListado() {
    alert("html");
    window.location = "/html/listado.html";

}
function loginProfesor() {
    //Con esta función comprobamos la identidad de la persona que se queire logear

    var nick = document.getElementById("form_nick").value;
    var password = document.getElementById("form_password").value;

    var url = "../public_html/php/dao/ProfesorDAO.php?";
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        data: {log_nick: nick, log_password: password},
        async: false,
        success: function (data) {
             var div = document.getElementById("errLogin");
            console.log(data);
            if (data.datos == 'ERROR_CONEX') {
                var err = "Ha habido un problema con el servidor, contacte con el administrador";
                mostrarErr(div, err);
            } else if (data.datos == 'VACIO') {
                var err = "Ese nombre no correponde a nigún usuario";
                mostrarErr(div, err);
            }else if(data.datos["pro_login"] != nick || data.datos["pro_password"] != password){
                var err = "Contraseña y/o nombre de usuario incorrectos";
                mostrarErr(div, err);
            }else if(data.datos["pro_login"] == nick || data.datos["pro_password"] == password){
                esLogeado();
                ocultarrErr(div);
            }else{
                var err = "Error, contacta con el administrador";
                mostrarErr(div, err);
            }
           

          


        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log(xhr.responseText);
        }
    });

}

function esLogeado() {
    //cosas que se habilitan si se logea
    document.getElementById("logeado").style.display = "block";
}
function mostrarErr(div, err) {
    div.style.display = "block";
    div.style.color = "red";
    div.innerHTML = err;
}

function ocultarrErr(div) {
    div.style.display = "none";
   
}