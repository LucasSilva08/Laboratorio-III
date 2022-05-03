//import {IParte2} from './Iparte2';
var PrimerParcial;
(function (PrimerParcial) {
    var Manejadora = /** @class */ (function () {
        function Manejadora() {
        }
        Manejadora.AgregarProductoJSON = function () {
            var xhr = new XMLHttpRequest();
            var nombre = document.getElementById("nombre").value;
            var origen = document.getElementById("cboOrigen").value;
            xhr.open("POST", "./BACKEND/AltaProductoJSON.php");
            var formD = new FormData();
            formD.append("nombre", nombre);
            formD.append("origen", origen);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                        alert(xhr.responseText);
                    }
                }
            };
            xhr.send(formD);
        };
        Manejadora.MostrarProductosJSON = function () {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "./BACKEND/ListadoProductosJSON.php");
            xhr.send();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var productos = JSON.parse(xhr.responseText);
                        var tabla_1 = "<table><tr><td>Nombre</td><td>Origen</td></tr>";
                        productos.forEach(function (element) {
                            tabla_1 += "<tr><td>" + element.nombre + "</td><td>" + element.origen + "</td></tr>";
                        });
                        tabla_1 += "</table>";
                        document.getElementById("divTabla").innerHTML = tabla_1;
                        console.log(xhr.responseText);
                    }
                }
            };
        };
        Manejadora.VerificarProductoJSON = function () {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "./BACKEND/VerificarProductoJSON.php");
            var formD = new FormData();
            var nombre = document.getElementById("nombre").value;
            var origen = document.getElementById("cboOrigen").value;
            formD.append("nombre", nombre);
            formD.append("origen", origen);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                        alert(xhr.responseText);
                    }
                }
            };
            xhr.send(formD);
        };
        Manejadora.MostrarInfoCookie = function () {
            var xhr = new XMLHttpRequest();
            var nombre = document.getElementById("nombre").value;
            var origen = document.getElementById("cboOrigen").value;
            xhr.open("GET", "./BACKEND/MostrarCookie.php?" + "nombre=" + nombre + "&origen=" + origen);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                        document.getElementById("divInfo").innerHTML = xhr.responseText;
                    }
                }
            };
            xhr.send();
        };
        Manejadora.AgregarProductoSinFoto = function () {
            var nombre = document.getElementById("nombre").value;
            var origen = document.getElementById("cboOrigen").value;
            var precio = document.getElementById("precio").value;
            var codigo_barra = document.getElementById("codigoBarra").value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "./Backend/AgregarProductoSinFoto.php");
            xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        alert(xhr.responseText);
                        console.log(xhr.responseText);
                        Manejadora.MostrarProductosEnvasados();
                    }
                }
            };
            xhr.send('producto_json=' + '{"nombre":"' + nombre + '","origen":"' + origen + '","id":"","codigo_barra":"' + codigo_barra + '","precio":"' + precio + '"}');
        };
        Manejadora.MostrarProductosEnvasados = function () {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "./BACKEND/ListadoProductosEnvasados.php?tabla=json");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var productos = JSON.parse(xhr.responseText);
                        var tabla_2 = "<table><tr><th>Nombre</th><th>Origen</th><th>CodBarra</th><th>Id</th><th>Precio</th><th>Foto</th></tr>";
                        productos.forEach(function (element) {
                            var auxJson = JSON.stringify(element);
                            tabla_2 += "<tr>";
                            tabla_2 += "<td>" + element.nombre + "</td>";
                            tabla_2 += "<td>" + element.origen + "</td>";
                            tabla_2 += "<td>" + element.codigo_barra + "</td>";
                            tabla_2 += "<td>" + element.id + "</td>";
                            tabla_2 += "<td>" + element.precio + "</td>";
                            tabla_2 += "<td> <img src='./Backend/productos/imagenes/" + element.pathFoto + "';width='50' height='50'></td>";
                            //tabla +='<td> <input type="button" value="Modificar" class="btn btn-danger" onclick=PrimerParcial.Manejadora.ModificarSinFoto(auxJson)/>'
                            if (!document.getElementById("hdnIdModificacion").value) {
                                tabla_2 += "<td> <input type=\"button\" value=\"Modificar\" class=\"btn btn-info\" onclick=PrimerParcial.Manejadora.CargarForm('" + auxJson + "')></td>";
                                tabla_2 += "<td> <input type=\"button\" value=\"Eliminar\" class=\"btn btn-outline-danger\" onclick=PrimerParcial.Manejadora.EliminarProducto('" + auxJson + "')></td>";
                            }
                            else {
                                tabla_2 += "<td> <input type=\"button\" value=\"Modificar Env\" class=\"btn btn-info\" onclick=PrimerParcial.Manejadora.CargarForm('" + auxJson + "')></td>";
                                tabla_2 += "<td> <input type=\"button\" value=\"Eliminar Env\" class=\"btn btn-outline-danger\" onclick=PrimerParcial.Manejadora.BorrarProductoFoto('" + auxJson + "')></td>";
                            }
                            tabla_2 += "</tr>";
                        });
                        tabla_2 += "</table>";
                        console.log(xhr.responseText);
                        document.getElementById("divTabla").innerHTML = tabla_2;
                    }
                }
            };
            xhr.send();
        };
        Manejadora.CargarForm = function (json) {
            var parseado = JSON.parse(json);
            document.getElementById("nombre").value = parseado.nombre;
            document.getElementById("cboOrigen").value = parseado.origen.toString();
            document.getElementById("idProducto").value = parseado.id;
            document.getElementById("codigoBarra").value = parseado.codigo_barra;
            document.getElementById("precio").value = parseado.precio;
        };
        Manejadora.LevantarJSON = function () {
            var nombre = document.getElementById("nombre").value;
            var origen = document.getElementById("cboOrigen").value;
            var id = document.getElementById("idProducto").value;
            var codigo_barra = document.getElementById("codigoBarra").value;
            var precio = document.getElementById("precio").value;
            return '{"nombre":"' + nombre + '","origen":"' + origen + '","id":"' + id + '","codigo_barra":"' + codigo_barra + '","precio":"' + precio + '"}';
        };
        Manejadora.prototype.EliminarProducto = function (json) {
            Manejadora.EliminarProducto(json);
        };
        Manejadora.EliminarProducto = function (json) {
            var miJson = JSON.parse(json);
            var input = confirm("Queres borrar este producto?" + miJson.nombre + " " + miJson.origen);
            if (input) {
                var xhr_1 = new XMLHttpRequest();
                xhr_1.open("POST", "./Backend/EliminarProductoEnvasado.php");
                xhr_1.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                xhr_1.onreadystatechange = function () {
                    if (xhr_1.readyState === 4) {
                        if (xhr_1.status === 200) {
                            alert(xhr_1.responseText);
                            console.log(xhr_1.responseText);
                            Manejadora.MostrarProductosEnvasados();
                        }
                    }
                };
                xhr_1.send('producto_json=' + json);
            }
        };
        Manejadora.ModificarSinFoto = function (json) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "./Backend/ModificarProductoEnvadado.php");
            xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                        var jsonRespuesta = JSON.parse(xhr.responseText);
                        if (jsonRespuesta.exito) {
                            Manejadora.MostrarProductosEnvasados();
                        }
                        else {
                            alert(xhr.responseText);
                            console.log(xhr.responseText);
                        }
                    }
                }
            };
            xhr.send("producto_json=" + json);
        };
        Manejadora.prototype.ModificarProducto = function (json) {
            Manejadora.ModificarProducto(json);
        };
        Manejadora.ModificarProducto = function (json) {
            var miJson = JSON.parse(json);
            var tabla = "<table><tr><th>Nombre</th><th>Origen</th><th>CodBarra</th><th>Id</th><th>Precio</th><th>Foto</th></tr>";
            tabla += "<tr>"
                + "<td>" + miJson.nombre + "</td>"
                + "<td>" + miJson.origen + "</td>"
                + "<td>" + miJson.codigo_barra + "</td>"
                + "<td>" + miJson.id + "</td>"
                + "<td>" + miJson.precio + "</td>"
                + "<td> <img src='" + miJson.pathFoto + "';width='50' height='50'></td>"
                + "</tr>";
            tabla += "</table>";
            document.getElementById("divTabla").innerHTML = tabla;
        };
        Manejadora.prototype.VerificarProductoEnvasado = function () {
            Manejadora.VerificarProductoEnvasado();
        };
        Manejadora.VerificarProductoEnvasado = function () {
            var xhr = new XMLHttpRequest();
            var nombre = document.getElementById("nombre").value;
            var origen = document.getElementById("cboOrigen").value;
            xhr.open("POST", "./Backend/VerificarProductoEnvasado.php");
            xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        document.getElementById("divInfo").innerHTML = xhr.responseText;
                        console.log(xhr.responseText);
                    }
                }
            };
            xhr.send('obj_producto={"nombre":"' + nombre + '","origen":"' + origen + '"}');
        };
        Manejadora.prototype.AgregarProductoFoto = function () {
            Manejadora.AgregarProductoFoto();
        };
        Manejadora.AgregarProductoFoto = function () {
            var nombre = document.getElementById("nombre").value;
            var origen = document.getElementById("cboOrigen").value;
            var txtPrecio = document.getElementById("precio").value;
            var codigoBarras = document.getElementById("codigoBarra").value;
            var foto = document.getElementById("foto");
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "./Backend/AgregarProductoEnvasado.php");
            var form = new FormData();
            form.append("nombre", nombre);
            form.append("origen", origen);
            form.append("precio", txtPrecio);
            form.append("codigo_barra", codigoBarras);
            form.append("pathFoto", foto.files[0]);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                        Manejadora.MostrarProductosEnvasados();
                    }
                }
            };
            xhr.send(form);
        };
        Manejadora.prototype.BorrarProductoFoto = function (json) {
            Manejadora.BorrarProductoFoto(json);
        };
        Manejadora.BorrarProductoFoto = function (json) {
            var miJson = JSON.parse(json);
            var input = confirm("Queres borrar este producto?" + miJson.nombre + " " + miJson.codigo_barra);
            if (input) {
                var xhr_2 = new XMLHttpRequest();
                xhr_2.open("POST", "./Backend/BorrarProductoEnvasado.php");
                xhr_2.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                xhr_2.onreadystatechange = function () {
                    if (xhr_2.readyState === 4) {
                        if (xhr_2.status === 200) {
                            alert(xhr_2.responseText);
                            console.log(xhr_2.responseText);
                            Manejadora.MostrarProductosEnvasados();
                        }
                    }
                };
                xhr_2.send('producto_json=' + json);
            }
        };
        Manejadora.prototype.ModificarProductoFoto = function (json) {
            Manejadora.ModificarProductoFoto(json);
        };
        Manejadora.ModificarProductoFoto = function (json) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "./Backend/ModificarProductoEnvadadoFoto.php");
            var foto = document.getElementById("foto");
            var form = new FormData();
            form.append("foto", foto.files[0]);
            form.append("producto_json", json);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        alert(xhr.responseText);
                        console.log(xhr.responseText);
                        Manejadora.MostrarProductosEnvasados();
                    }
                }
            };
            xhr.send(form);
        };
        Manejadora.prototype.MostrarBorradosJSON = function () {
            Manejadora.MostrarBorradosJSON();
        };
        Manejadora.MostrarBorradosJSON = function () {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "./BACKEND/MostrarBorradosJSON.php");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                        document.getElementById("divInfo").innerHTML = xhr.responseText;
                    }
                }
            };
            xhr.send();
        };
        Manejadora.prototype.MostrarFotosModificados = function () {
            Manejadora.MostrarFotosModificados();
        };
        Manejadora.MostrarFotosModificados = function () {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "./BACKEND/MostrarFotosDeModificados.php");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                        document.getElementById("divInfo").innerHTML = xhr.responseText;
                    }
                }
            };
            xhr.send();
        };
        Manejadora.prototype.FiltrarListado = function () {
            Manejadora.FiltrarListado();
        };
        Manejadora.FiltrarListado = function () {
            throw new Error("Method not implemented.");
        };
        return Manejadora;
    }());
    PrimerParcial.Manejadora = Manejadora;
})(PrimerParcial || (PrimerParcial = {}));
