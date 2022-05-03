<?php

require_once("./clases/ProductoEnvasados.php");

$data = json_decode($_POST["producto_json"]);

$prod = new ProductoEnvasado($data->nombre,$data->origen,null,$data->codigoBarra,$data->precio);

$rta = new stdClass();
if($prod->agregar($prod))
{
    $rta->exito = true;
    $rta->mensaje = "Agregado con exito";
}else{
    $rta->exito = false;
    $rta->mensaje = "NO fue Agregado";
}
echo json_encode($rta);
?>