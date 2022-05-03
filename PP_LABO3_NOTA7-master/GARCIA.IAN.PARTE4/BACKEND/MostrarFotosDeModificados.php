<?php
    include_once "./clases/ProductoEnvasado.php";
    echo "<table>";
    echo "<tr>";
    echo "<th>Foto</th>";
    echo "</tr>";
    $listado = ProductoEnvasado::MostrarModificados();
    foreach($listado as $prod)
    {
        echo "<tr>";
            echo "<td>" . "<img src='./BACKEND/".$prod."';width='50' height='50'>" . "</td>";
        echo "</tr>";
    }
    echo "</table>";
?>