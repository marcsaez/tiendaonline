<?php
require_once("database.php");
class cateoria extends database{
    private $nombre;
    private $categoria;
    
    //GETTERS Y SETTERS
    function getNombre(){
        return $this->nombre;
    }
    function getCategoria(){
        return $this ->categoria;
    }
    function setNombre($nombre){
        $this->nombre = $nombre;
    }
    function setCategoria($categoria){
        $this->categoria = $categoria;
    }

    //FUNCIONES QUE EJECUTARA ESTA CLASE
}
?>
