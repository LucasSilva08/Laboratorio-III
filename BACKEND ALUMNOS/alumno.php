<?php
namespace Silva;

class Alumno{

	public int $legajo;
	public string $nombre;
	public string $apellido;

	public function __construct(int $legajo, string $nombre, string $apellido)
	{
		$this->legajo = $legajo;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
	}

	public static function agregar(Alumno $obj) : bool {

		$retorno = false;

		//ABRO EL ARCHIVO
		$ar = fopen("./archivos/crud.txt", "a");//A - append

		//ESCRIBO EN EL ARCHIVO CON FORMATO: CLAVE-VALOR_UNO-VALOR_DOS
		$cant = fwrite($ar, "{$obj->legajo} - {$obj->apellido} - {$obj->nombre}\r\n");

		if($cant > 0)
		{
			$retorno = true;			
		}

		//CIERRO EL ARCHIVO
		fclose($ar);

		return $retorno;
	}

	public static function listar() : string {

		$retorno = "";

		//ABRO EL ARCHIVO
		$ar = fopen("./archivos/crud.txt", "r");

		//LEO LINEA X LINEA DEL ARCHIVO 
		while(!feof($ar))
		{
			$retorno = $retorno . fgets($ar) . "<br>";;		
		}

		//CIERRO EL ARCHIVO
		fclose($ar);

		return $retorno;
	}

	public static function modificar(Alumno $obj) {
		$elementos = array();
		//ABRO EL ARCHIVO
		$ar = fopen("./archivos/crud.txt", "r");
		//LEO LINEA X LINEA DEL ARCHIVO 
		while(!feof($ar))
		{
			$linea = fgets($ar);
			//http://www.w3schools.com/php/func_string_explode.asp
			$array_linea = explode(" - ", $linea);

			$array_linea[0] = trim($array_linea[0]);

			if($array_linea[0] != ""){
				//RECUPERO LOS CAMPOS
				$legajo = trim($array_linea[0]);
				$apellido = trim($array_linea[1]);
				$nombre = trim($array_linea[2]);

				if ($legajo == $obj->legajo) {
					
					array_push($elementos, "{$legajo} - {$obj->apellido} - {$obj->nombre}\r\n");
				}
				else{

					array_push($elementos, "{$legajo} - {$apellido} - {$nombre}\r\n");
				}
			}
		}
		//CIERRO EL ARCHIVO
		fclose($ar);
		//ABRO EL ARCHIVO
		$ar = fopen("./archivos/crud.txt", "w");
		//ESCRIBO EN EL ARCHIVO
		foreach($elementos AS $item){

			fwrite($ar, $item);
		}
		//CIERRO EL ARCHIVO
		fclose($ar);
	}

	public static function borrar(int $leg) {
		$elementos = array();
		//ABRO EL ARCHIVO
		$ar = fopen("./archivos/crud.txt", "r");
		//LEO LINEA X LINEA DEL ARCHIVO 
		while(!feof($ar))
		{
			$linea = fgets($ar);
			//http://www.w3schools.com/php/func_string_explode.asp
			$array_linea = explode(" - ", $linea);

			$array_linea[0] = trim($array_linea[0]);

			if($array_linea[0] != ""){

				//RECUPERO LOS CAMPOS
				$legajo = trim($array_linea[0]);
				$apellido = trim($array_linea[1]);
				$nombre = trim($array_linea[2]);

				if ($legajo == $leg) {
					
					continue;
				}
				array_push($elementos, "{$legajo} - {$apellido} - {$nombre}\r\n");
			}
		}

		//CIERRO EL ARCHIVO
		fclose($ar);
		//ABRO EL ARCHIVO
		$ar = fopen("./archivos/crud.txt", "w");

		//ESCRIBO EN EL ARCHIVO
		foreach($elementos AS $item){

 			$cant = fwrite($ar, $item);
		}

		//CIERRO EL ARCHIVO
		fclose($ar);

		
	}

	public static function verificar(int $leg):bool{

		$retorno=false;
		$ar = fopen("./archivos/crud.txt", "r");

		//LEO LINEA X LINEA DEL ARCHIVO 
		while(!feof($ar))
		{
			$linea = fgets($ar);
			//http://www.w3schools.com/php/func_string_explode.asp
			$array_linea = explode(" - ", $linea);
			$array_linea[0] = trim($array_linea[0]);
			if($array_linea[0] != ""){
				
				$legajo = trim($array_linea[0]);
				
				if ($legajo == $leg) {
					$retorno=true;
					
				}
				
			}
		}

		//CIERRO EL ARCHIVO
		fclose($ar);
		return $retorno;
	}
}