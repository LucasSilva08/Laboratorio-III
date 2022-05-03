<?php
    include_once "./clases/ProductoEnvasado.php";

    $rta = new stdClass();
    $rta->exito = false;
    $rta->mensaje = "error al modificar";

    $mod = json_decode($_POST["producto_json"],true);
    $foto = $_FILES["foto"]["tmp_name"];
    $ext = pathinfo($_FILES["foto"]["name"],PATHINFO_EXTENSION);
    $fotoPath=$mod["nombre"].".".$mod["origen"].".".date("His").".".$ext;
    $nuevaFoto ="./productosModificados/".$mod["nombre"].".".$mod["origen"]."modificado".date("His").".".$ext;
    if(isset($mod["pathFoto"]))
    {
        $foto= $mod["pathFoto"];
    }
    $prod = new ProductoEnvasado($mod["nombre"],$mod["origen"],$mod["id"],$mod["codigo_barra"],$mod["precio"],$fotoPath);

    if($prod->Modificar())
    {
        //rename($this->pathFoto, "./productosModificados/".$prod->nombre.".".$prod->origen."modificado".time("H:i:s"));
        //move_uploaded_file($fotoMod,$nuevaFoto);
        copy($foto,"./productos/imagenes/".$fotoPath);
        move_uploaded_file($foto,$nuevaFoto);
        $rta->exito = true;
        $rta->mensaje = "exito al modificar";
    }
    echo json_encode($rta);
?>