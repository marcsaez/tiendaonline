<?php
require_once("database.php");
class productos extends database{
    private $nombre;
    private $descripcion;

    private $Imagen;
    private $stock;
    private $destacado;
    private $precio;
    private $categoria;

    //GETTERS Y SETTERS
    function getNombre() {
        return $this->nombre;
    }
    function getDescripcion() {
        return $this->descripcion;
    }
    function getImg() {
        return $this->Imagen;
    }
    function getStock() {
        return $this->stock;
    }
    function getDestacado() {
        return $this->destacado;
    }
    function getPrecio() {
        return $this->precio;
    }
    function getCategoria() {
        return $this->categoria;
    }
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    function setImg($Imagen) {
        $this->Imagen = $Imagen;
    }
    function setStock($stock) {
        $this->stock = $stock;
    }
    function setDestacado($destacado) {
        $this->destacado = $destacado;
    }
    function setPrecio($price) {
       $this->precio = $price;
    }
    function setCategoria($cat) {
        $this->categoria = $cat;
    }

    //FUNCIONES QUE EJECUTARA ESTA CLASE
    
}
?>