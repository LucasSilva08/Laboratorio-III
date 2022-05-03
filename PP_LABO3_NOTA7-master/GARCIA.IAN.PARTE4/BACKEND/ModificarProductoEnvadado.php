<?php
    include_once "./clases/ProductoEnvasado.php";

    $rta = new stdClass();
    $rta->exito = false;
    $rta->mensaje = "error al modificar";     
    $mod = json_decode($_POST["producto_json"],true);
    try 
    {
        $p = new ProductoEnvasado($mod["nombre"],$mod["origen"],$mod["id"],$mod["codigo_barra"],$mod["precio"],null);
        if($p->Modificar())
        {
            $rta->exito = true;
            $rta->mensaje = "Modificado con exito";
        }
    } 
    catch(PDOException $e) 
    {
        echo $sql . "<br>" . $e->getMessage();
    }
    echo json_encode($rta);
?>