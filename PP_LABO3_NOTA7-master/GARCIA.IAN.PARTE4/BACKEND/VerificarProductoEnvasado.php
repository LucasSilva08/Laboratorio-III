<?php
    include_once "./clases/ProductoEnvasado.php";
    $rta = json_encode(array());
    if(isset($_POST["obj_producto"]))
    {
        $json = json_decode($_POST["obj_producto"]);
        $miarray=ProductoEnvasado::Traer();
        if(count($miarray)>0)
        {
            foreach($miarray as $producto)
            {
                $Prod = new ProductoEnvasado($producto->nombre,$producto->origen,$producto->id,$producto->codigo_barra,$producto->precio,$producto->pathFoto);
                if ($producto->nombre == $json->nombre && $producto->origen == $json->origen) 
                {
                    $rta = $Prod->ToJSON();
                }
            }
        }
    }
    echo json_encode($rta);
?>