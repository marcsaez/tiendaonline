<?php
require_once ".models/usuario.php";
$db = Usuario::staticConectar();
class Usuario{
    public function registrarUsuario(){
        $usuario = new usuario ($_POST['usuarioEmail'],$_POST['usuarioTelefono'],$_POST['usuarioNombre'],$_POST['usuarioApellido'],$_POST['usuarioDireccion'],$_POST['usuarioPassword']);
        $usuario->conectar();
        $registro=$usuario->registrarUsuario();
        if($registro == true){
            
        }else{
            
        }
    }

}
?>