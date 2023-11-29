<?php
require_once("database.php");
class Cliente extends database{
    private $email;
    private $telefono;

    private $Nombre;

    private $Apellido;

    private $Direccion;
    
    //GETTERS Y SETTERS
    function getNombre() {
        return $this->Nombre;
    }
    function getEmail() {
        return $this->email;
    }
    function getTelf() {
        return $this->telefono;
    }
    function getApellido() {
        return $this->Apellido;
    }
    function getDireccion() {
        return $this->Direccion;
    }
    function setNombre($nombre) {
        $this->Nombre = $nombre;
    }
    function setEmail($email) {
        $this->email = $email;
    }
    function setTelf($telf) {
        $this->telefono = $telf;
    }
    function setApellido($apellido) {
        $this->Apellido = $apellido;
    }
    function setDireccion($direccion) {
        $this->Direccion = $direccion;
    }

    //FUNCIONES QUE EJECUTARA ESTA CLASE
}
?>