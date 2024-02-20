<?php
require_once("database.php");
class compra extends database{
private $estado;
private $preciototal;
private $fechacreacion;
private $fechaenvio;
private $cliente;

//GETTERS Y SETTERS
function getEstado() {
    return $this->estado;
}
function getPrecioTotal() {
    return $this->preciototal;
}
function getFechaCreacion() {
    return $this->fechacreacion;
}
function getFechaEnvio() {
    return $this->fechaenvio;
}
function getCliente() {
    return $this->cliente;
}
function setEstado($estado) {
    $this->estado = $estado;
}
function setPrecioTotal($price) {
    $this->preciototal = $price;
}
function setFechaCreacion($fecha) {
    $this->fechacreacion = $fecha;
}
function setFechaEnvio($fecha) {
    $this->fechaenvio = $fecha;
}
function setCliente($cliente) {
    $this->cliente = $cliente;
}

//FUNCIONES QUE EJECUTARA ESTA CLASE
public static function enviarPedido($db, $id){
    try{
        $fecha = date("Y-m-d");
        $stmt = $db->prepare("UPDATE purchases SET senddate = :fecha WHERE purchaseid = :id ");
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $stmt->bindParam(':estado', $fecha);

    }catch (Exception $e){
        $resultados = null;
    }
    
    return $resultados;
}
}
?>