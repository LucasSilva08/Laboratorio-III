<?php
namespace Silva;
use PDO;

class Alumno{

	public int $legajo;
	public string $nombre;
	public string $apellido;
	public string $foto;

	public function __construct(int $legajo=0, string $nombre="", string $apellido="",string $foto="")
	{
		$this->legajo = $legajo;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->foto = $foto;
	}

	public static function agregar_bd(Alumno $obj){
		$objAccesoDato = AccesoDatos::unObjetoAcceso();
		$consulta = $objAccesoDato->retornarConsulta("INSERT INTO alumnos (legajo, apellido, nombre, foto)"
												."VALUES(:legajo, :apellido, :nombre, :foto)");
		
		$consulta->bindValue(':legajo',$obj->legajo, PDO::PARAM_INT);
		$consulta->bindValue(':apellido',$obj->apellido, PDO::PARAM_STR);
		$consulta->bindValue(':nombre',$obj->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':foto',$obj->foto, PDO::PARAM_STR);
		return $consulta->execute();
	}

	public static function listar_bd(){
		$objAccesoDato = AccesoDatos::unObjetoAcceso();
		$consulta = $objAccesoDato->retornarConsulta("SELECT legajo, apellido, nombre, foto FROM alumnos");
		$consulta->execute();
		$array=array();
		while($obj= $consulta->fetchObject()){
			array_push($array, new Alumno($obj->legajo,$obj->nombre,$obj->apellido,$obj->foto));
		}
		return $array;		
	}

	public static function obtener_bd(int $legajo):Alumno|NULL{

		$objAccesoDato = AccesoDatos::unObjetoAcceso();
		$consulta = $objAccesoDato->retornarConsulta("SELECT legajo, apellido, nombre, foto FROM alumnos WHERE legajo = :legajo");
		$consulta->bindValue(':legajo',$legajo, PDO::PARAM_INT);
		$consulta->execute();
		$consulta->setFetchMode(PDO::FETCH_INTO,new Alumno);
		$obj=NULL;

		foreach($consulta as $alumno){
			$obj= new Alumno($alumno->legajo,$alumno->nombre,$alumno->apellido,$alumno->foto);
		}	

		return $obj;

	}

	public static function modificar_bd(Alumno $obj){
		unlink($obj->foto);	
		$objAccesoDato = AccesoDatos::unObjetoAcceso();
		$consulta = $objAccesoDato->retornarConsulta("UPDATE alumnos SET apellido = :apellido, nombre = :nombre, foto = :foto 
														WHERE legajo = :legajo");

		$consulta->bindValue(':legajo',$obj->legajo, PDO::PARAM_INT);
		$consulta->bindValue(':apellido',$obj->apellido, PDO::PARAM_STR);
		$consulta->bindValue(':nombre',$obj->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':foto',$obj->foto, PDO::PARAM_STR);

		return $consulta->execute();
	}

	

	public static function borrar_bd(int $legajo)
	{	$obj=Alumno::obtener_bd($legajo);
		unlink($obj->foto);
		$objAccesoDato = AccesoDatos::unObjetoAcceso();
		$consulta = $objAccesoDato->retornarConsulta("DELETE FROM alumnos WHERE legajo = :legajo");
		$consulta->bindValue(':legajo',$legajo, PDO::PARAM_INT);
		return $consulta->execute();
	}

}