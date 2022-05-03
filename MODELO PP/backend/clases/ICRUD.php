<?php
namespace Silva;

interface ICRUD{
    static function TraerTodosF();
    function AgregarF();
    function ModificarF();
    static function EliminarF($id);
    
}
?>