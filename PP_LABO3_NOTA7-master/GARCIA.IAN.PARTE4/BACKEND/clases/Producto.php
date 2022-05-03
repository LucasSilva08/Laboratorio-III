<?php
class Producto{
    public $nombre;
    public $origen;

    public function __construct($nombre,$origen)
    {
        $this->nombre=$nombre;
        $this->origen=$origen;        
    }
    public function TOJSON()
    {
        return json_encode($this);
    }
    public function GuardarJson($path)
    {
        $rtaJSON = new stdClass();
        $rtaJSON->exito = false;
        $rtaJSON->mensaje = "No se pudo agregar el producto!!!";

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
                $rtaJSON->exito = true;
                $rtaJSON->mensaje = "Se guardo en el archivo";

            }

            fclose($archivo);
        }
        else
        {
            $lectura = explode("]", $aux);

                if(fwrite($archivo, $lectura[0] . "," . $this->ToJSON() . "]") != 0)
                {
                    $rtaJSON->exito = true;
                    $rtaJSON->mensaje = "Se guardo en el archivo";
                }
                fclose($archivo);
        }
        return json_encode($rtaJSON);
    }
    public static function TraerJSON($path){
        $productos = array();
        $string = file_get_contents($path);
        $decodeo = json_decode($string, true);
        foreach($decodeo as $decodeado)
        {
            $producto = new Producto($decodeado["nombre"],$decodeado["origen"]);
            array_push($productos, $producto);
        }
        return $productos;
    }
    public static function VerificarProductoJSON($producto)
    {
        $cantidad = 0;
        $retorno = new stdClass();
        $retorno->exito = false;

        $array = Producto::TraerJSON("./archivos/productos.json");
        foreach ( $array as $element ) 
        {
            if ($producto->nombre == $element->nombre && $producto->origen == $element->origen) 
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