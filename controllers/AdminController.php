<?php
    class AdminController{
        public function Login(){
            
            if(isset($_POST)){
               
                require_once "models/cliente.php";
                $cliente = new cliente();
                $cliente->conectar();
                $todosLosUsuarios = $cliente->iniciarSesion($_POST['usuario'], $_POST['password']);
                 if($todosLosUsuarios == true){
                     
                     require_once "views/admin/principalAdmin.php";
                 }
            }
        }
    }
?>