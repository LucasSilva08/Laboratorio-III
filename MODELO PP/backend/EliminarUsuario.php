<?php
require_once("./clases/Usuario.php");
use Silva\Usuario;

$id= isset($_POST["id"]) ?  (int)$_POST["id"] : 0;
$obj = new stdClass();
if(isset($_POST["accion"])){
    if(Usuario::Eliminar($id)){
        $obj->exito = true;
        $obj->mensaje = "Usuario ELIMINADO";
        var_dump(json_encode($obj));
    }
    else{
        $obj->exito = false;
        $obj->mensaje = "ERROR AL ELIMINAR";
        var_dump(json_encode($obj));
    }
}
else
{
    echo "ERROR";
}
?>