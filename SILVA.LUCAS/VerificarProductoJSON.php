<?php
    require_once("./clases/Producto.php");
    use Silva_Lucas\Producto;

    $nombre = isset($_POST["nombre"]) ?  $_POST["nombre"] : NULL;
    $origen = isset($_POST["origen"]) ? $_POST["origen"] : NULL;

    $respuesta = new stdClass();
    $respuesta->exito = false;
    $respuesta->mensaje = "NO EXISTE LA COOKIE";
    if($nombre != NULL && $origen !=NULL)
    {
        $producto = new Producto($nombre,$origen);
        //echo $_POST["nombre"].$_POST["origen"];
        $aux=json_decode(Producto::verificarProductoJSON($producto));
        if($aux->exito){
            $mensaje = date("m.d.y G:i:s")." ".$aux->mensaje;
            setcookie($nombre."_".$nombre,$mensaje);
            $respuesta->exito = true;
            $respuesta->mensaje = "Existe ".$aux->mensaje;
        }
    }
    echo json_encode($respuesta);
?>
