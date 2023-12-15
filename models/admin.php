<?php
require_once("database.php");

class Admin extends database{
    private $emailAdmin;
    private $passwordAdmin;

    function getEmailAdmin() {
        return $this->emailAdmin;
    }
    function getPasswordAdmin() {
        return $this->passwordAdmin;
    }
    function setEmailAdmin($emailAdmin) {
        $this->Apellido = $emailAdmin;
    }
    function setPasswordAdmin($passwordAdmin) {
        $this->Direccion = $passwordAdmin;
    }

    public function iniciarSesion($email, $contrasena) {
        $stmt = $this->db->prepare("SELECT * FROM admin WHERE emailadmin = :email AND passwordadmin  = :contrasena");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $administartor = $stmt->fetch(PDO::FETCH_ASSOC);
            // Inicio de sesión exitoso
            session_start();
            $_SESSION['admin_id'] = $administartor['emailadmin'];
            // Puedes hacer otras acciones después del inicio de sesión
            return true;
        } else {
            
        }
    }

}
?>