<?php
include_once "Producto.php";
include_once("IParte1.php");
include_once("IParte2.php");
include_once("IParte3.php");
class ProductoEnvasado extends Producto implements IParte1,IParte2,IParte3
{
    public $id;
    public $codigo_barra;
    public $precio;
    public $pathFoto;
    public function __construct($nombre=NULL,$origen=NULL,$id=NULL,$codigo_barra=NULL,$precio=NULL,$pathFoto=NULL)
    {
        parent::__construct($nombre,$origen);
        $this->nombre=$nombre;
        $this->id=$id;
        $this->codigo_barra=$codigo_barra;
        $this->precio=$precio;
        $this->pathFoto=$pathFoto;
    }
    public function ToJSON()
    {
        return json_encode($this);
    }
    public function Agregar(){
      $retorno = false;
      $sql = "ERROR";       

      try 
      {
        $conn = new PDO("mysql:host=localhost;dbname=productos_bd", "root", " ");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO productos (codigo_barra, nombre, origen, precio, foto) 
                VALUES ('".$this->codigo_barra."', '".$this->nombre."', '".$this->origen."', '".$this->precio."', '".$this->pathFoto."')";
        if($conn->exec($sql)>0)
        {
          $retorno = true;
        }
      } 
      catch(PDOException $e) 
      {
        echo $sql . "<br>" . $e->getMessage();
      }

      return $retorno;
  }
  static public function Traer()
  {
    $sql = "ERROR";       
    try 
    {
      $conn = new PDO("mysql:host=localhost;dbname=productos_bd", "root", " ");
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sentencia = $conn->prepare('SELECT * FROM `productos`');
      $sentencia->execute();
      $arrayUsuarios = $sentencia->fetchAll();
      $arrayReturn = array();
      foreach($arrayUsuarios as $usuarios)
      {
        $persona = new ProductoEnvasado($usuarios[2],$usuarios[3],$usuarios[0],$usuarios[1],$usuarios[4],$usuarios[5]);
        array_push($arrayReturn,$persona);
      }
    } 
    catch(PDOException $e) 
    {
      echo $sql . "<br>" . $e->getMessage();
    }

    return  $arrayReturn;
  }
  public function Modificar()
  {
      $retorno = false;
      $sql = "ERROR";       
      try 
      {
        $conn = new PDO("mysql:host=localhost;dbname=productos_bd", "root", " ");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE `productos` SET `id`='".$this->id."',`codigo_barra`='".$this->codigo_barra."',`nombre`='".$this->nombre."',`origen`='".$this->origen."',`precio`='".$this->precio."',`foto`='".$this->pathFoto."' WHERE `ID`='".$this->id."'";
        if($conn->exec($sql)>0)
        {
          $retorno = true; 
        }
      } 
      catch(PDOException $e) 
      {
        echo $sql . "<br>" . $e->getMessage();
      }
      return $retorno;

      
  }
  static public function Eliminar($id)
  {
      $retorno = false;
      $sql = "ERROR";       

      try 
      {
        $conn = new PDO("mysql:host=localhost;dbname=productos_bd", "root", " ");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'DELETE FROM `productos` WHERE ID='.$id;
        if($conn->exec($sql)>0)
        {
          $retorno = true;
        }
        else
        {
          $retorno = false;
        }
      } 
      catch(PDOException $e) 
      {
        echo $sql . "<br>" . $e->getMessage();
      }
      return $retorno;
  }
  function Existe($array)
  {
      foreach($array as $producto)
      {
        if($producto->nombre==$this->nombre&&$producto->origen==$this->origen)
        {
          return true;
        }
      }
      return false;
  }
  function GuardarEnArchivo()
  {
    $path = "./archivos/productos_envasados_borrados.txt";
    $fecha =date("His");
    $newPath = "./ProductosBorrados/".$this->id.".".$this->nombre."."."borrado".".".$fecha."."."jpg";
    if(file_exists($this->pathFoto))
    {
      rename($this->pathFoto, $newPath);
    }
    $this->pathFoto = $newPath;

    if(file_exists($path))
    {
      $archivo = fopen($path,"r");

      if(filesize($path) > 0)
      {
        $aux = fread($archivo, filesize($path));
      }

      fclose($archivo);

      $archivo = fopen($path,"w");
    }
    else
    {
      $archivo = fopen($path,"a");
    }

    if(filesize($path) == 0)
    {
      if(fwrite($archivo, "[". $this->ToJSON() . "]") != 0)
      {

      }

      fclose($archivo);
    }
    else
    {
      $lectura = explode("]", $aux);

        if(fwrite($archivo, $lectura[0] . "," . $this->ToJSON() . "]") != 0)
        {

        }
        
        fclose($archivo);
    }
  }
  public static function MostrarBorradosJSON()
  {
    $arr = Producto::TraerJSON("./archivos/productos_eliminados.json");
    foreach($arr as $in)
    {
      echo "Nombre ".$in->nombre.", origen ".$in->origen."</br>";
    }
  }
  public static function MostrarModificados()
  {
    $dir = "./productosModificados/";
    $arr = array();
    $imagesJpg = glob($dir . "/*.jpg");
    foreach($imagesJpg as $img)
    {
      array_push($arr,$img);
    }
    $imagesJpeg = glob($dir . "/*.jpeg");
    foreach($imagesJpeg as $img)
    {
      array_push($arr,$img);
    }
    $imagesGif = glob($dir . "/*.gif");
    foreach($imagesGif as $img)
    {
      array_push($arr,$img);
    }
    $imagesPng = glob($dir . "/*.png");
    foreach($imagesPng as $img)
    {
      array_push($arr,$img);
    }
    return $arr;
  }
}

?>