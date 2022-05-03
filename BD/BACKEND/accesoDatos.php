<?php
namespace Silva;
use PDO;
use PDOException;

class AccesoDatos{
    private static AccesoDatos $objAccesoDatos;
    private PDO $objPDO;

    private function __construct()
    {
        try{
            $usuario = 'root';
            $clave = '';
            $this->objPDO = new PDO('mysql:host=localhost;dbname=alumno_pdo;charset=utf8', $usuario, $clave);
        } catch (PDOException $e){
            print "Error!!!<br/>" . $e->getMessage();
            die();
        }
    }

    public function retornarConsulta (string $sql){
        return $this->objPDO->prepare($sql);
    }
    public static function unObjetoAcceso():AccesoDatos{
        if(!isset(self::$objAccesoDatos)){
            self::$objAccesoDatos = new AccesoDatos();
        }
        return self::$objAccesoDatos;
    }

    public function __clone()
    {
        trigger_error('La clonaci&oacute;n de este objeto no est&aacute; permitida!!!', E_USER_ERROR);
    }
}
?>