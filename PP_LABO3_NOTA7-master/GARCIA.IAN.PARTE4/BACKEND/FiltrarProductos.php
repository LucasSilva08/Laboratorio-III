<?php
    include_once "./clases/ProductoEnvasado.php";
    echo ' <table align="center">';
    echo "<tr>";
    echo "<th>Nombre</th>";
    echo "<th>Origen</th>";
    echo "<th>Codigo</th>";
    echo "<th>Id</th>";
    echo "<th>Precio</th>";
    echo "<th>Foto</th>";
    echo "</tr>";

    $array = ProductoEnvasado::Traer();
    if(isset($_POST["origen"])&&isset($_POST["nombre"]))
    {
        $nombre = $_POST["nombre"];
        $origen = $_POST["origen"];
        foreach ( $array as $prod ) 
        {
            if ($nombre == $prod["nombre"] && $origen == $prod["origen"]) 
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
        }
    }
    else
    {
        if(isset($_POST["origen"]))
        {
            $origen = $_POST["origen"];
            foreach ( $array as $prod ) 
            {
                if ($origen == $prod["origen"]) 
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
            }
        }
        else if(isset($_POST["nombre"]))
        {
            $nombre = $_POST["nombre"];
            foreach ( $array as $prod ) 
            {
                if ($nombre == $prod["nombre"]) 
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
            }
        }
    }
    echo '</table>';
?>