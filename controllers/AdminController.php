<?php
    class AdminController{
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
        
        

        public function listarCategorias(){
            require_once "views/admin/listarCategorias.php";
            require_once "models/categorias.php";
            $categoria = new categoria();
            $categoria->conectar();
            $allcategories = $categoria->listarTodasCategorias();
        }

        public function paginaAnadirCategoria(){
            require_once "views/admin/anadirCategoria.php";
        }
        
    }
?>