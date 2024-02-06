<?php
require_once("database.php");
class Cliente extends database{
    private $emailCliente;
    private $telefono;
    private $Nombre;
    private $Apellido;
    private $Direccion;
    
    //GETTERS Y SETTERS
    function getNombre() {
        return $this->Nombre;
    }
    function getEmailCliente() {
        return $this->emailCliente;
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
    function setEmailCliente($emailCliente) {
        $this->emailCliente = $emailCliente;
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

    // Iniciar sesion cliente
    public function iniciarSesion($email, $contrasena) {
        $stmt = $this->db->prepare("SELECT * FROM customers WHERE email = :email AND customerPassword  = :contrasena");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            // Inicio de sesión exitoso
            session_start();
            $_SESSION['usuario_id'] = $usuario['email'];
            // Puedes hacer otras acciones después del inicio de sesión
            return true;
        } else {
            
            return false;
        }
    }

}
?>