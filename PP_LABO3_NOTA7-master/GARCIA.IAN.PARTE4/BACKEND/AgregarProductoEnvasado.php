<?php
include_once "./clases/ProductoEnvasado.php";
$codBarra=$_POST["codigo_barra"];
$nombre=$_POST["nombre"];
$origen=$_POST["origen"];
$precio=$_POST["precio"];
$ext = $_FILES["pathFoto"]["name"];
$foto = $_FILES["pathFoto"]["tmp_name"];
$tiposArchivo = pathinfo($ext, PATHINFO_EXTENSION);
$nuevoPath=$nombre.".".$origen.".".date("His").".".$tiposArchivo;

$prod= new ProductoEnvasado($nombre,$origen,NULL,$codBarra,$precio,$nuevoPath);
$rta = new stdClass();
$rta->exito = false;
$rta->mensaje = "error al agregar";
if($prod->Existe(ProductoEnvasado::Traer()))
{
    echo "ese producto ya existe en la db";
    $rta->exito = false;
    $rta->mensaje = "ya existe en la db";
}else{
    move_uploaded_file($foto, $nuevoPath);
    $prod->Agregar();
    $rta->exito = true;
    $rta->mensaje = "exito al agregar";
}
echo json_encode($rta);
?>