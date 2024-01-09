<?php
    class CategoriasController{
        public function listarCategorias(){
            require_once "models/categorias.php";
            $db = categoria::staticConectar();
            $allcategories = categoria::listarTodasCategorias($db);
            require_once "views/admin/listarCategorias.php";
        }
        public static function menuCategorias(){
            require_once "models/categorias.php";
            $db = Categoria::staticConectar();
            $allcategories = Categoria::listarTodasCategorias($db);
            require_once "views/general/headeradmin.php";
        }
        public function anadirCategoria(){
            if(isset($_POST)){
                require_once "models/categorias.php";
                // $padre=$_POST['categoriaPadre'];
                // $nombre=$_POST['nombre'];
                // echo $padre, $nombre;
                $categoria = new categoria($_POST['nombre'],$_POST['categoriaPadre']);
                $categoria->conectar();
                $allcategories = $categoria->anadir();
                if ($allcategories){
                    ?>
                    <script>
                        alert("Producto creado correctamente");
                    </script>
                    <?php
                    header("Location: index.php?Controller=Categorias&action=listarCategorias");
                } else{
                    ?>
                    <script>
                        alert("Error en alguno de los datos");
                    </script>
                    <?php
                    header("Location: index.php?Controller=Categorias&action=listarCategorias");
                }
            }
            
            
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