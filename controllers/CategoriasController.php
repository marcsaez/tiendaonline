<?php
    class CategoriasController{
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