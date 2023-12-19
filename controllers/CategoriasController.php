<?php
    class CategoriasController{
        public function listarCategorias(){
            require_once "models/categorias.php";
            $db = categoria::staticConectar();
            $allcategories = categoria::listarTodasCategorias($db);
            require_once "views/admin/listarCategorias.php";
        }

        public function anadirProducto(){
            require_once "views/admin/anadirProductos.php";
            
        }

        public function eliminar(){
            require_once "models/categorias.php";
            if (isset($_GET['id'])) {

                $idcategoria = $categoria->setIDCategoria($_GET['id']);
                $categoria = categoria::actualizarCategoria($_GET['id']);
            } else 
                // Si no se proporciona 'id' en la URL, muestra un mensaje de error o realiza otra acción
                echo "Error: ID de categoría no proporcionado en la URL";
            }
        }
    
?>