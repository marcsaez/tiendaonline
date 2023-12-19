<?php
    class CategoriasController{
        public function listarCategorias(){
            require_once "models/categorias.php";
            $db = Categoria::staticConectar();
            $allcategories = Categoria::listarTodasCategorias($db);
            require_once "views/admin/listarCategorias.php";
        }

        public function paginaAnadirCategoria(){
            require_once "views/admin/anadirCategoria.php";
        }
    }
?>