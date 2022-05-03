<?php
include_once "./clases/Producto.php";
$nombre = $_POST["nombre"];
$origen = $_POST["origen"];
$miProducto = new Producto($nombre,$origen);
$rta = new stdClass();
if($miProducto->GuardarJSON('./archivos/productos.json'))
{
    $rta->exito = true;
    $rta->mensaje = "Agregado con exito";
}else{
    $rta->exito = false;
    $rta->mensaje = "Error al agregar";
}
    echo json_encode($rta);
?>