<?php
    require_once("./clases/Producto.php");
    //use Silva_Lucas\Producto;

    $nombre = isset($_POST["nombre"]) ?  $_POST["nombre"] : NULL;
    $origen = isset($_POST["origen"]) ? $_POST["origen"] : NULL;

    $respuesta = new stdClass();
    $respuesta->exito = false;
    $respuesta->mensaje = "Esa cookie no existe";
       
    if(isset($_COOKIE[$nombre."_".$origen])) 
    {
        $respuesta->exito = true;
        $respuesta->mensaje = "Se creo una cookie ".$_COOKIE[$nombre."_".$origen];
    } 
    echo json_encode($respuesta);
?>