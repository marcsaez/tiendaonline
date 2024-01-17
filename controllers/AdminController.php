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
                    echo '<meta http-equiv="refresh" content="0;url=index.php?Controller=Admin&action=mostrarDashboard">';
                    $this->mostrarDashboard();
                }
            }
        }
        
        public function mostrarDashboard() {
            require_once "views/admin/navLateral.php";
            require_once "views/admin/principalAdmin.php";
        }

        public function logOut() {
            session_destroy();
            echo '<meta http-equiv="refresh" content="0;url=index.php">';
        }
        
    }
?>