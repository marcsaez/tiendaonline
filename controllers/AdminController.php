<?php
    class AdminController{

        // Login para administrador
        public function Login(){
            if(isset($_POST)){
                
                require_once "models/admin.php";
                $admin = new Admin();
                $admin->conectar();
                $todosLosAdmin = $admin->iniciarSesion($_POST['adminUser'], $_POST['passwordAdmin']);
                 if($todosLosAdmin == true){
                     require_once "views/admin/principalAdmin.php";
                 }
            }
        }
        
    }
?>