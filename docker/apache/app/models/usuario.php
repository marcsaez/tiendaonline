<?php
require_once("database.php");
class Usuario extends database{
    private $correo;
    private $telefono;
    private $nombre;
    private $apellido;
    private $direccion;
    private $password;

    //Contructor
public function __construct($correo, $telefono, $nombre, $apellido, $direccion, $password) {
    $this->correo = $correo;
    $this->telefono = $telefono;
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->direccion = $direccion;
    $this->password = $password;
}
    //Getters
    public function getCorreo() {
        return $this->correo;
    }
    public function getTelefono() {
        return $this->telefono;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function getApellido() {
        return $this->apellido;
    }
    public function getDireccion() {
        return $this->direccion;
    }
    public function getPassword() {
        return $this->password;
    }
    //Setters
    public function setCorreo($correo) {
        $this->correo = $correo;
    }
    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }
    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
    public function setPassword($password) {
        $this->password = $password;
    }

    public function registrarUsuario() {
        $success = false;
        try {
            // Verificar si ya existe el correo en la tabla customers
            $stmtCheckEmail = $this->db->prepare("SELECT email FROM customers WHERE email = :email");
            $stmtCheckEmail->bindParam(':email', $this->correo);
            $stmtCheckEmail->execute();
            // Obtener el resultado de la consulta
            $resultadoCheckEmail = $stmtCheckEmail->fetch(PDO::FETCH_ASSOC);
            // Verificar si ya existe el correo
            if ($resultadoCheckEmail === false) {
                // El correo no existe, proceder con el registro
                // Hash de la contraseña con SHA256
                $hashedPassword = hash('sha256', $this->password);
                // Insertar datos en la tabla customers
                $stmtInsertUsuario = $this->db->prepare("INSERT INTO customers (email, customerphone, customername, customersurname, customeraddress, customerpassword) 
                                                        VALUES (:email, :telefono, :nombre, :apellido, :direccion, :password)");
                $stmtInsertUsuario->bindParam(':email', $this->correo);
                $stmtInsertUsuario->bindParam(':telefono', $this->telefono);
                $stmtInsertUsuario->bindParam(':nombre', $this->nombre);
                $stmtInsertUsuario->bindParam(':apellido', $this->apellido);
                $stmtInsertUsuario->bindParam(':direccion', $this->direccion);
                $stmtInsertUsuario->bindParam(':password', $hashedPassword);
                $stmtInsertUsuario->execute();
                // Marcar el registro como exitoso
                $success = true;
            } else {
                // El correo ya existe, no se puede registrar
                $success = false;
            }
        } catch (Exception $e) {
            // Manejar cualquier excepción que pueda ocurrir durante la ejecución de la consulta
            echo "Error: " . $e->getMessage();
            $success = false;
        }
        return $success;
    }
    public static function iniciarSesion($db, $correo, $password){
        $success = false;
        try {
            $hashedPassword = hash('sha256', $password);
            $stmt = $db->prepare("SELECT * FROM customers WHERE email = :email and customerpassword = :pass;");
            $stmt->bindParam(':email', $correo);
            $stmt->bindParam(':pass', $hashedPassword);
            $stmt->execute();
            $datosCorrectos = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($datosCorrectos !== false) {
                // Eliminar sesión 'loginMal' si existe
                if (isset( $_SESSION['loginError'])) {
                    unset( $_SESSOIN['loginError']);
                }
                if(isset($_SESSION['carrito'])){
                    $_SESSION['carritoLogeado']=$_SESSION['carrito'];
                    unset($_SESSION['carrito']);
                }
                // Almacenar datos en la sesión
                $_SESSION['userType'] = "usuario";
                $_SESSION['userMail'] = $datosCorrectos['email'];
                $_SESSION['userNombre'] = $datosCorrectos['customername'];
                $_SESSION['userApellido'] = $datosCorrectos['customersurname'];
                $_SESSION['userDireccion'] = $datosCorrectos['customeraddress'];
                $success = true;
            } else {
                $_SESSON['loginError']= "Error, correo o contraseña incorrectos";
                $success = false;
            }
        } catch (PDOException $e) {
            $_SESSON['loginError']= "Error, correo o contraseña incorrectos";
            $success = false;
            echo "Error en el inicio de sesión: " . $e->getMessage();
        }
    
        return $success;
    }
}    
?>