<?php
    require_once("./clases/Producto.php");
    use Silva_Lucas\Producto;
    if(isset($_GET["accion"])){
    echo json_encode(Producto::traerJSON("./archivos/productos.json"));
    }
?>