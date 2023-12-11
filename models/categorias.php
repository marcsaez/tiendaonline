<?php
require_once("database.php");
class cateoria extends database{
    private $nombre;
    private $categoriaPadre;
    
    //GETTERS Y SETTERS
    function getNombre(){
        return $this->nombre;
    }
    function getCategoriaPadre(){
        return $this ->categoriaPadre;
    }
    function setNombre($nombre){
        $this->nombre = $nombre;
    }
    function setCategoriaPadre($categoriaPadre){
        $this->categoriaPadre = $categoriaPadre;
    }

    //FUNCIONES QUE EJECUTARA ESTA CLASE
}
?>
