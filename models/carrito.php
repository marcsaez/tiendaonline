<?php
require_once("databse.php");
class carrito extends database{
private $codigocompra;
private $producto;
private $cantidad;
private $preciototal;

//GETTERS Y SETTERS
function getCodigoCompra() {
    return $this->codigocompra;
}
function getProducto() {
    return $this->producto;
}
function getCantidad() {
    return $this->cantidad;
}
function getPrecioTotal() {
    return $this->preciototal;
}
function setCodigoCompra($codigo) {
    $this->codigocompra = $codigo;
}
function setProducto($product) {
    $this->producto = $product;
}
function setCantidad($cantidad) {
    $this->cantidad = $cantidad;
}
function setPrecioTotal($total) {
    $this->preciototal = $total;
}

//FUNCIONES QUE EJECUTARA ESTA CLASE
}
?>