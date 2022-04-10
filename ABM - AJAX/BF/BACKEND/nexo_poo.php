<?php
require_once("./alumno.php");

use Silva\Alumno;

use function PHPSTORM_META\elementType;

//RECUPERO TODOS LOS VALORES (POST)
$accion = isset($_REQUEST["accion"]) ?  $_REQUEST["accion"] : NULL;
$legajo = isset($_REQUEST["legajo"]) ? (int) $_REQUEST["legajo"] : 0;
$nombre = isset($_REQUEST["nombre"]) ? $_REQUEST["nombre"] : NULL;
$apellido = isset($_REQUEST["apellido"]) ? $_REQUEST["apellido"] : NULL;

//****************************************** */
//CRUD - SOBRE ARCHIVOS
//****************************************** */

switch($accion)
{
	case "agregar"://Create (Alta)

		$obj = new Alumno($legajo, $nombre, $apellido);

		if(Alumno::agregar($obj)){

			echo "<h2> registro AGREGADO </h2><br/>";	
		}

		break;

	case "listar"://Read (listar)

		echo Alumno::listar();

		break;

	case "verificar":
		
		if(Alumno::verificar($legajo))
		{
			echo '<h2> El alumno con legajo '. $legajo .' se encuentra en el listado </h2><br/>';
		}
		else{
			echo '</h2> El alumno con legajo '. $legajo .' no se encuentra en el listado </h2><br/>';
		}
		break;

	case "modificar"://Update (Modificar)

		$obj = new Alumno($legajo, $nombre, $apellido);

		if(Alumno::verificar($obj->legajo))
		{
			Alumno::modificar($obj);
			echo '<h2> El alumno con legajo '. $legajo .' se ha modificado </h2><br/>';			
		}
		else{
			echo '</h2> El alumno con legajo '. $legajo .' no se encuentra en el listado </h2><br/>';
		}

		break;

	case "borrar"://Delete (Borrar)

		if(Alumno::verificar($legajo))
		{
			Alumno::borrar($legajo);
			echo '<h2> El alumno con legajo '. $legajo .' se ha Borrado </h2><br/>';			
		}
		else{
			echo '</h2> El alumno con legajo '. $legajo .' no se encuentra en el listado </h2><br/>';
		}

		break;
				
	default:
		echo "<h2> Sin ejemplo </h2>";
}