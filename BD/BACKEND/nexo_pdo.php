<?php
require_once("./accesoDatos.php");
require_once("./alumno.php");

//use Silva\AccesoDatos;
use Silva\Alumno;


$accion = isset($_REQUEST["accion"]) ?  $_REQUEST["accion"] : NULL;
$legajo = isset($_REQUEST["legajo"]) ? (int) $_REQUEST["legajo"] : 0;
$nombre = isset($_REQUEST["nombre"]) ? $_REQUEST["nombre"] : NULL;
$apellido = isset($_REQUEST["apellido"]) ? $_REQUEST["apellido"] : NULL;

switch($accion)
{
	case "agregar"://Create (Alta)
		//if(Alumno::obtener_bd($legajo)==NULL){

		$foto = "./fotos/" . $_FILES["archivo"]["name"];
		$pathFoto="./fotos/".$legajo.".".pathinfo($foto,PATHINFO_EXTENSION);

        $obj = new Alumno($legajo, $nombre, $apellido,$pathFoto);

        if(Alumno::agregar_bd($obj)==1){;
        move_uploaded_file($_FILES["archivo"]["tmp_name"], $pathFoto);
	    echo "<h2> registro AGREGADO </h2><br/>";
		}
		else{
			echo "<h2> El Alumno YA SE ENCUENTRA EN EL LISTADO </h2><br/>";
		}
		break;

	case "listar"://Read (listar)
        var_dump(Alumno::listar_bd());	

		break;

	case "obtener":
		
    $obj=Alumno::obtener_bd($legajo);
    var_dump($obj);
       
		
		break;

	case "modificar"://Update (Modificar)

		if(Alumno::obtener_bd($legajo)!=NULL){

		$foto = "./fotos/" . $_FILES["archivo"]["name"];
		$pathFoto="./fotos/".$legajo.".".pathinfo($foto,PATHINFO_EXTENSION);

		$obj = new Alumno($legajo, $nombre, $apellido,$pathFoto);

        Alumno::modificar_bd($obj);
        move_uploaded_file($_FILES["archivo"]["tmp_name"], $pathFoto);
		echo '<h2> El alumno con legajo '. $legajo .' se ha Modificado </h2><br/>';
		}
		else{
			echo '<h2> El alumno con legajo '. $legajo .' No se encuentra en el Listado </h2><br/>';
		}

		

		break;

	case "borrar"://Delete (Borrar)

		if(Alumno::obtener_bd($legajo)!=NULL){
            Alumno::borrar_bd($legajo);
    		echo '<h2> El alumno con legajo '. $legajo .' se ha Borrado </h2><br/>';
        }
		else{
			echo '<h2> El alumno con legajo '. $legajo .' No se encuentra en el Listado </h2><br/>';
		}		

		break;
	
	case "redirigir":
		session_start();
		$obj=Alumno::obtener_bd($legajo);
		if($obj!=NULL){
		$_SESSION["legajo"] = $obj->legajo;
        $_SESSION["nombre"] = $obj->nombre;
        $_SESSION["apellido"] = $obj->apellido;
        $_SESSION["foto"] = $obj->foto;
		header('./principal');
		//var_dump($_SESSION);
		}
		else{
			echo '<h2> El alumno con legajo '. $legajo .' No se encuentra en el Listado </h2><br/>';
		}

	break;
				
	default:
		echo "<h2> Sin ejemplo </h2>";
}
?>