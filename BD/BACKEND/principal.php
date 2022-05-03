<?php
use Silva\Alumno;
require_once("./accesoDatos.php");
require_once("./alumno.php");
/*session_start();
if(isset($_SESSION)){
    echo "<h1>".$_SESSION["legajo"]."</h1>";
    echo "<h2>".$_SESSION["nombre"]." ". $_SESSION["apellido"]."</h2>";
    echo '<img src= $_SESSION["foto"]>'.'<br>';
    echo '<table>'. Silva\Alumno::listar_bd() .'</table> ';
} 
else{
    //echo '<a href="nexo_poo_foto.php" >Ir a otra p&aacute;gina</a><br/>';
    header('./nexo_poo_foto');
}*/
$alumnos = Alumno::listar_bd();
?>
<body>
    <table class ="table table -ligth">
        <thead class="thead-light">
             <tr>
                <th>LEGAJO</th>
                <th>APELLIDO</th>
                <th>NOMBRE</th>
                <th>FOTO</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($alumnos as $obj){
            ?>
            <tr>
                <td><?php echo $obj->legajo;?></td>
                <td><?php echo $obj->apellido;?></td>
                <td><?php echo $obj->nombre;?></td>
                <td><img src="<?php echo $obj->foto;?>" width="100px" height="100px"></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <form name="form" action="../listado_pdf.php" method="post">
        <select name="select"> <!--onchange='window.location.href="../listado_pdf.php"'-->
            <option selected disabled>Seleccionar</option>
            <option value="visualizar">Visualizar</option>
            <option value="descargar">Descargar</option>
        </select>
        <br>
        <a href="../listado_pdf.php">
            <input type="submit" value="click here">
        </a>
    </form>
</body>
