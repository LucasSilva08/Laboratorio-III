<?php
include_once "./clases/ProductoEnvasado.php";

//$data = json_decode(file_get_contents('php://input'), true);
$data = json_decode($_POST["producto_json"], true);

$prod = new ProductoEnvasado($data["nombre"],$data["origen"],null,$data["codigo_barra"],$data["precio"]);

$rta = new stdClass();
if($prod->Agregar($prod))
{
    $rta->exito = true;
    $rta->mensaje = "Agregado con exito";
}else{
    $rta->exito = false;
    $rta->mensaje = "NO fue Agregado";
}
echo json_encode($rta);
?>