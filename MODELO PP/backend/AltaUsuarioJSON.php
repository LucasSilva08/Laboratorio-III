<?php

require_once("./clases/Usuario.php");
use Silva\Usuario;

$correo = isset($_POST["correo"]) ?  $_POST["correo"] : NULL;
$clave = isset($_POST["clave"]) ? $_POST["clave"] : NULL;
$nombre = isset($_REQUEST["nombre"]) ? $_REQUEST["nombre"] : NULL;

$usuario = new Usuario();
$usuario->nombre = $nombre;
$usuario->clave = $clave;
$usuario->correo = $correo;

var_dump($usuario->GuardarEnArchivo());

?>