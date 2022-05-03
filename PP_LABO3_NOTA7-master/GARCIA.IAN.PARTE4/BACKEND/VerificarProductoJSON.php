<?php
    include_once "./clases/Producto.php";

    $rta2 = new stdClass();
    $rta2->exito = false;
    $rta2->mensaje = "NO EXISTE LA COOKIE";
    if(isset($_POST["nombre"])&&isset($_POST["origen"]))
    {
        $producto = new Producto($_POST["nombre"],$_POST["origen"]);
        echo $_POST["nombre"].$_POST["origen"];
        $rta=json_decode(Producto::VerificarProductoJSON($producto));
        if($rta->exito){
            $mensaje = date("His")." ".$rta->mensaje;
            setcookie($_POST["nombre"]."_".$_POST["origen"],$mensaje);
            $rta2->exito = true;
            $rta2->mensaje = "Existe ".$rta->mensaje;
        }
    }
    echo json_encode($rta2);
?>
