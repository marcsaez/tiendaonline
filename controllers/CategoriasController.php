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
            $totalCategorias = Categoria::navCategorias($db);
            require_once "views/general/header.php";
        }
        public function anadirCategoria(){
            if(isset($_POST)){
                require_once "models/categorias.php";
                $categoria = new categoria(null,$_POST['nombre'],$_POST['categoriaPadre']);
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
        public function editarCategoria(){
            if(isset($_POST)){
                require_once "models/categorias.php";
                $id=$_POST['id'];
                $nombre=$_POST['nombre'];
                $categoriaPadre=$_POST['categoriaPadre'];
                echo $id, $nombre, $categoriaPadre;
            }
        }
        public function eliminar(){
            if (isset($_GET['IDCategoria'])) {
                require_once "models/categorias.php";
                $id = $_GET['IDCategoria'];
                // echo $id;
                $categoria = new categoria($id, null, null);
                $categoria->conectar();
                // echo $categoria->IDCategoria;
                $actualizada=$categoria->actualizarCategoria();
                if($actualizada==true){
                    header("Location: index.php?Controller=Categorias&action=listarCategorias");
                }else{
                    echo $actualizada;
                    sleep(5);
                    header("Location: index.php?Controller=Categorias&action=listarCategorias");
                }
            } else {
                // Si no se proporciona 'id' en la URL, muestra un mensaje de error o realiza otra acción
                echo "Error: ID de categoría no proporcionado en la URL";
            }
        }
    }
    
?>