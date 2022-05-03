<?php
    include "./clases/ProductoEnvasado.php";

    $listado = json_encode(ProductoEnvasado::Traer());
    $listado = json_decode($listado, true);
    if(isset($_GET["tabla"])&&$_GET["tabla"]=="mostrar")
    {
        echo "<tr>";
            echo "<th>Nombre</th>";
            echo "<th>Origen</th>";
            echo "<th>Codigo</th>";
            echo "<th>Id</th>";
            echo "<th>Precio</th>";
            echo "<th>Foto</th>";
        echo "</tr>";
        foreach($listado as $prod)
        {
            echo "<tr>";
                echo "<td>".$prod["nombre"]."</td>";
                echo "<td>".$prod["origen"]."</td>";
                echo "<td>".$prod["codigo_barra"]."</td>";
                echo "<td>".$prod["id"]."</td>";
                echo "<td>".$prod["precio"]."</td>";
                echo "<td>" . "<img src='".$prod["pathFoto"]."';width='50' height='50'>" . "</td>";
            echo "</tr>";
        }
    }else
    {
        echo json_encode($listado);
    }
        ?>