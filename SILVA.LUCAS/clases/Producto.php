<?php
namespace Silva_Lucas;
use stdClass;


class Producto{
    public $nombre;
    public $origen;

    public function __construct($nombre,$origen){
        $this->nombre = $nombre;
        $this->origen = $origen;        
    }

    public function toJSON(){
        return json_encode($this);
    }

    public function guardarJSON($path){
        $respuesta = new stdClass();
                
        if(!(file_exists($path))){
            $ar = fopen($path,"a");
            $cant = fwrite($ar, "[".$this->ToJSON()."]");
            fclose($ar);
        }
        else{
            $ar = fopen($path,"r");
            $aux = fread($ar,filesize($path));
            $lectura = explode("]",$aux);
            fclose($ar);
            $ar = fopen($path,"w");
            $cant = fwrite($ar, $lectura[0].",\r\n".$this->ToJSON()."]");
            fclose($ar);
        }
        

        if($cant>0)
        {
            $respuesta->exito=TRUE;
            $respuesta->mensaje="Se ah Guardado Correctamente";
            
        }
        else{
            $respuesta->exito=false;
            $respuesta->mensaje="NO se ah Guardado Correctamente";
        }

        return json_encode($respuesta);
    }

    public static function traerJSON($path){

        $retorno=array();
        $json=file_get_contents($path);
        $aux= json_decode($json);
    
        foreach($aux as $obj){

            $producto = new Producto($obj->nombre,$obj->origen);     
            
            array_push($retorno,$producto);
        }
        return $retorno;
    }

    public static function verificarProductoJSON($producto)
    {
        $cantidad = 0;
        $retorno = new stdClass();
        $retorno->exito = false;

        $array = Producto::TraerJSON("./archivos/productos.json");
        foreach ( $array as $obj ) 
        {
            if ($producto->nombre == $obj->nombre && $producto->origen == $obj->origen) 
            {
                $cantidad++;
                $retorno->exito = true;
                $retorno->mensaje = "Cantidad de productos de igual origen: " . $cantidad;
            }
        }
        if(!$retorno->exito)
        {
            $out = array();
            foreach($array as $el)
            {
                $key = serialize($el);
                if (!isset($out[$key]))
                {
                    $out[$key]=1;
                }
                else
                {
                    $out[$key]++;
                }
            }
            arsort($out);
            foreach($out as $el=>$count)
            {
                $item = unserialize($el);
                $retorno->mensaje = "El producto mas popular es = nombre " . $item->nombre . " Origen " . $item->origen;
                break;
            }
        }
        return Json_encode($retorno);
    }
}
?>