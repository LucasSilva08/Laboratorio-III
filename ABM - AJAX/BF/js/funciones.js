"use strict";
var Ajax;
(function (Ajax) {
    let xhttp = new XMLHttpRequest();
    function MostrarListado() {
        xhttp.open("GET", "BACKEND/nexo_poo.php?accion=listar", true);
        xhttp.send();
        xhttp.onreadystatechange = () => {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("div_listado").innerHTML = xhttp.responseText;
            }
        };
    }
    Ajax.MostrarListado = MostrarListado;
    function Verificar() {
        xhttp.open("POST", "BACKEND/nexo_poo.php", true);
        let legajo = document.getElementById("legajo_v").value;
        let form = new FormData();
        form.append('accion', 'verificar');
        form.append('legajo', legajo);
        xhttp.send(form);
        xhttp.onreadystatechange = () => {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                alert(xhttp.responseText);
            }
        };
    }
    Ajax.Verificar = Verificar;
    function Agregar() {
        xhttp.open("POST", "BACKEND/nexo_poo.php", true);
        let form = new FormData();
        let legajo = document.getElementById("legajo").value;
        let apellido = document.getElementById("apellido").value;
        let nombre = document.getElementById("nombre").value;
        form.append('accion', 'agregar');
        form.append('legajo', legajo);
        form.append('apellido', apellido);
        form.append('nombre', nombre);
        xhttp.send(form);
        xhttp.onreadystatechange = () => {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                alert(xhttp.responseText);
                MostrarListado();
            }
        };
    }
    Ajax.Agregar = Agregar;
    function Modificar() {
        xhttp.open("POST", "BACKEND/nexo_poo.php", true);
        let form = new FormData();
        let legajo = document.getElementById("legajo_m").value;
        let apellido = document.getElementById("apellido_m").value;
        let nombre = document.getElementById("nombre_m").value;
        form.append('accion', 'modificar');
        form.append('legajo', legajo);
        form.append('apellido', apellido);
        form.append('nombre', nombre);
        xhttp.send(form);
        xhttp.onreadystatechange = () => {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                alert(xhttp.responseText);
                MostrarListado();
            }
        };
    }
    Ajax.Modificar = Modificar;
    function Borrar() {
        xhttp.open("POST", "BACKEND/nexo_poo.php", true);
        let legajo = document.getElementById("legajo_b").value;
        let form = new FormData();
        form.append('accion', 'borrar');
        form.append('legajo', legajo);
        xhttp.send(form);
        xhttp.onreadystatechange = () => {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                alert(xhttp.responseText);
                MostrarListado();
            }
        };
    }
    Ajax.Borrar = Borrar;
})(Ajax || (Ajax = {}));
//# sourceMappingURL=funciones.js.map