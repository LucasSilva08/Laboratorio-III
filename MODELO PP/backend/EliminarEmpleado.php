<?php
require_once("./clases/Empleado.php");
use Silva\Empleado;

$id= isset($_POST["id"]) ?  (int)$_POST["id"] : 0;
$obj = new stdClass();

    if(Empleado::EliminarF($id)){
        $obj->exito = true;
        $obj->mensaje = "Usuario ELIMINADO";
        var_dump(json_encode($obj));
    }
    else{
        $obj->exito = false;
        $obj->mensaje = "ERROR AL ELIMINAR";
        var_dump(json_encode($obj));
    }

?>