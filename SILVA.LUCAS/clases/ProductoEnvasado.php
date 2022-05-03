<?php
namespace Silva_Lucas;
require_once("./clases/Producto.php");
require_once("./clases/IParte1.php");


use PDO;
use PDOException;

class ProductoEnvasado extends Producto implements IParte1
{
    public $id;
    public $codigoBarra;
    public $precio;
    public $pathFoto;

    public function __construct($nombre=NULL,$origen=NULL,$id=NULL,$codigoBarra=NULL,$precio=NULL,$pathFoto=NULL)
    {
        parent::__construct($nombre,$origen);
        //$this->nombre=$nombre;
        $this->id=$id;
        $this->codigoBarra=$codigoBarra;
        $this->precio=$precio;
        $this->pathFoto=$pathFoto;
    }
    public function toJSON()
    {
        return json_encode($this);
    }
    public function agregar(){
      $retorno = false;
    
      try 
      {
        $db = new PDO('mysql:host=localhost;dbname=productos_bd;charset=utf8',"root","");
        $consulta = $db->prepare("INSERT INTO productos (codigo_barra, nombre, origen, precio, foto)"
                                    ."VALUES(:codigo_barra, :nombre, :origen, :precio, :foto)");
            
            //$consulta->bindValue(":id",$this->id,PDO::PARAM_INT);
            $consulta->bindValue(":nombre",$this->nombre,PDO::PARAM_STR);
            $consulta->bindValue(":codigo_barra",$this->codigoBarra,PDO::PARAM_INT);
            $consulta->bindValue(":precio",$this->precio,PDO::PARAM_INT);
            $consulta->bindValue(":origen",$this->origen,PDO::PARAM_STR);
            $consulta->bindValue(":foto",$this->pathFoto,PDO::PARAM_STR);

            $consulta->execute();
            $retorno=true;
      } 
      catch(PDOException $e) 
      {
        echo  $e->getMessage();
      }

      return $retorno;
  }

  static public function traer()
  {
    $retorno=array();
           
    try 
    {
        $db = new PDO('mysql:host=localhost;dbname=productos_bd;charset=utf8',"root","");
        $consulta = $db->prepare("SELECT id, codigo_barra, nombre, origen, precio, foto FROM productos");
        $consulta->execute();
        while($obj = $consulta->fetchObject()){

            $producto= new ProductoEnvasado($obj->nombre,$obj->origen,$obj->id,$obj->codigoBarra,$obj->precio,$obj->foto);
            array_push($retorno, $producto);
        }
    }
    catch(PDOException $e) 
    {
      echo $e->getMessage();
    }
    return  $retorno;
}

}
?>