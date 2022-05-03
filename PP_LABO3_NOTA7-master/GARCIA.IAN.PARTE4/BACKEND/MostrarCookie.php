<?php
    include_once "./clases/Producto.php";
    $rta = new stdClass();
    $rta->exito = false;
    $rta->mensaje = "Esa cookie no existe";
    if(isset($_COOKIE[$_GET["nombre"]."_".$_GET["origen"]])) 
    {
        $rta->exito = true;
        $rta->mensaje = "Se creo una cookie ".$_COOKIE[$_GET["nombre"]."_".$_GET["origen"]];
    } 
    echo json_encode($rta);
?>