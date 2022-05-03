<?php
    include_once "./clases/ProductoEnvasado.php";

    if(isset($_POST["producto_json"]))
    {
        $json = json_decode($_POST["producto_json"],true);
        $rta = new stdClass();
        $rta->exito = false;
        $rta->mensaje = "error al borrar";
        if(ProductoEnvasado::Eliminar($json["id"]))
        {
            $prod = new ProductoEnvasado($json["nombre"],$json["origen"],$json["id"],$json["codigo_barra"],$json["precio"],$json["pathFoto"]);
            $rta->exito = true;
            $rta->mensaje = "producto eliminado con exito";
            $prod->GuardarEnArchivo();
        }
        echo json_encode($rta);
    }
    else
    {
        $data = file_get_contents("./archivos/productos_eliminados.json");
        $listado = json_decode($data, true);
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
        <table align="center">
        <tr>
            <th>Nombre</th>
            <th>Origen</th>
            <th>CodigoDeBarras</th>
            <th>ID</th>
            <th>Precio</th>
            <th>Foto</th>
        </tr>

            <?php
                foreach($listado as $producto)
                {
                    echo "<tr>";
                    echo "<td>".$producto["nombre"]."</td>";
                    echo "<td>".$producto["origen"]."</td>";
                    echo "<td>".$producto["codigoBarra"]."</td>";
                    echo "<td>".$producto["id"]."</td>";
                    echo "<td>".$producto["precio"]."</td>";
                    echo "<td>" . "<img src='./productos/imagenes".$prod["pathFoto"]."';width='50' height='50'>" . "</td>";
                    echo "</tr>";
                }
            ?>
        </body>
        </html>
    <?php
    }
?>
