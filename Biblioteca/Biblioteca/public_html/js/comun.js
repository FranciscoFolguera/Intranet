function crear_tabla(lista, utilidad) {
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
                td.appendChild(document.createTextNode(lista.datos[i][clave]));

            }
            if (clave === 'fecha prestamo') {
                var prestado = new Date(lista.datos[i][clave]).getTime();
                var ahora = new Date().getTime();
                var diffTime = Math.abs(ahora - prestado);
                var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            }
                         
          

            tr.appendChild(td);

        }
        if (utilidad === 'PRESTAMO' && diffDays >= 15) {
            tr.style.backgroundColor = "#ff4000";
        }
        
        tbdy.appendChild(tr);
    }
    tbl.appendChild(thead);

    tbl.appendChild(tbdy);
    body.appendChild(tbl);

}

