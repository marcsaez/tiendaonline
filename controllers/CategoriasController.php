<?php
    class CategoriasController{
        public function listarCategorias(){
            require_once "models/categorias.php";
            $db = Categoria::staticConectar();
            $allcategories = Categoria::listarTodasCategorias($db);
            require_once "views/admin/listarCategorias.php";
        }

        public function anadirProducto(){
            require_once "views/admin/anadirProductos.php";
            // if(isset($_POST)){
            //     require_once "models/categorias.php";
            //     $producto = new productos($_POST['idProducto'],$_POST['nombre'], $_POST['descripcion'], $_POST['imagen'], $_POST['stock'], isset($_POST['destacado']), $_POST['precio'], $_POST['categoria']);
            //     $producto->conectar();
            //     $allproducts = $producto->anadir();
            //     //QUITAR LOS SCRIPTS
            //     if ($allproducts){
            //         ?>
            //         <script>
            //             alert("Producto creado correctamente");
            //         </script>
            //         <?php
            //         header("Location: index.php?Controller=Productos&action=listarProductos");
            //     } else{
            //         ?>
            //         <script>
            //             alert("Error en alguno de los datos");
            //         </script>
            //         <?php
            //         require_once "views/admin/anadirProductos.php";
            //     }
            // }
        }
    }
?>