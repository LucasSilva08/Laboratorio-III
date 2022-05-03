<?php
  include_once "./clases/ProductoEnvasado.php";
  $rta = new stdClass();
  $rta->exito = false;
  $rta->mensaje = "error al eliminar";
  $mod = json_decode($_POST["producto_json"],true);

  if(ProductoEnvasado::Eliminar($mod["id"]))
  {
    $p = new Producto($mod["nombre"],$mod["origen"]);
    $p->GuardarJSON('./archivos/productos_eliminados.json');
    $rta->exito = true;
    $rta->mensaje = "exito al eliminar";
  }
  echo json_encode($rta);
?>