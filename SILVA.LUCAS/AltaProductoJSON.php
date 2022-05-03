<?php
require_once("./clases/Producto.php");
use Silva_Lucas\Producto;


$nombre = isset($_POST["nombre"]) ?  $_POST["nombre"] : NULL;
$origen = isset($_POST["origen"]) ? $_POST["origen"] : NULL;
$miProducto = new Producto($nombre,$origen);

$productoJSON=$miProducto->guardarJSON('./archivos/productos.json');
var_dump($productoJSON);

?>