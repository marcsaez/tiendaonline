<?php
require_once "./models/usuario.php";
class UsuarioController{
    public function registrarUsuario(){
        $usuario = new usuario ($_POST['usuarioEmail'],$_POST['usuarioTelefono'],$_POST['usuarioNombre'],$_POST['usuarioApellido'],$_POST['usuarioDireccion'],$_POST['usuarioPassword']);
        $usuario->conectar();
        $registro=$usuario->registrarUsuario();
        if($registro == true){
            echo '<meta http-equiv="refresh" content="0;url=index.php">';
        }else{
            UsuarioController::registrarseAbrir();
            echo '<p>El correo ya esta en uso</p>';
        }
    }
    
    public function iniciarSesionUsuario(){
        $db = Usuario::staticConectar();
        $usuario=Usuario::iniciarSesion($db,$_POST['correoUsuario'], $_POST['passUsuario']);
        if($usuario==true){
            echo '<meta http-equiv="refresh" content="0;url=index.php">';
        }elseif($usuario==false){
            echo '<meta http-equiv="refresh" content="0;url=index.php">';
        }
    }

    public function iniciarSesionAbrir(){
        require_once "views/general/popup.php";
    }
    public function registrarseAbrir(){
        require_once "views/general/registrarUsuario.php";
    }
    public function logOutUsuario() {
        session_destroy();
        echo '<meta http-equiv="refresh" content="0;url=index.php">';
    }
}

?>