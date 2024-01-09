<?php
    class ProductosController{
        public function listarProductos(){
            require_once "models/productos.php";
            $db = Productos::staticConectar();
            $allproducts = Productos::listarTodosProductos($db);
            include "views/admin/listarProductos.php";
        }
        public function anadirProducto(){
            if(isset($_POST)){
                require_once "models/productos.php";
                $producto = new productos($_POST['idProducto'],$_POST['nombre'], $_POST['descripcion'], $_POST['imagen'], $_POST['stock'], isset($_POST['destacado']), $_POST['precio'], $_POST['categoria']);
                $producto->conectar();
                $allproducts = $producto->anadir();
                //QUITAR LOS SCRIPTS
                if ($allproducts){
                    ?>
                    <script>
                        alert("Producto creado correctamente");
                    </script>
                    <?php
                    header("Location: index.php?Controller=Productos&action=listarProductos");
                } else{
                    ?>
                    <script>
                        alert("Error en alguno de los datos");
                    </script>
                    <?php
                    require_once "views/admin/anadirProductos.php";
                }
            }
        }
        public function paginaAnadirProductos(){
            $desplegable = ProductosController::mostrarCategorias();
            include "views/admin/anadirProductos.php";
        }
        public function editarProductos(){
            if(isset($_POST)){
                require_once "models/productos.php";
                $producto = new productos($_POST['id'],$_POST['nombre'], $_POST['descripcion'], $_POST['imagen'], $_POST['stock'], isset($_POST['destacado']), $_POST['precio'], $_POST['categoria']);
                $producto->conectar();
                $allproducts = $producto->actualizarProducto();
                if ($allproducts){
                    ?>
                    <script>
                        alert("Producto editado correctamente");
                    </script>
                    <?php
                    echo "<meta http-equiv='refresh' content='0;url=index.php?Controller=Productos&action=listarProductos'>";
                    
                } else{
                    ?>
                    <script>
                        alert("Error en el editado de los datos");
                    </script>
                    <?php
                    echo "<meta http-equiv='refresh' content='0;url=index.php?Controller=Productos&action=listarProductos'>";
                }
            }
        }
        
        public function paginaEditar(){
            if (isset($_GET['id'])) {
                require_once "models/productos.php";
                $idProducto = $_GET['id'];
                $db = Productos::staticConectar();
                // Obtener los detalles del producto con la ID especificada
                $productoDetalles = Productos::obtenerDetallesProducto($db, $idProducto);
                $productos = null;
                if (!empty($productoDetalles)) {
                    $productoRetornado = $productoDetalles;
                    include "views/admin/editarProductos.php";
    
                } else {
                    $productoRetornado = null;
                }
            } else {
                $productoRetornado = null;
    
            }
        }

        public function mostrarCategorias(){
            require_once "models/categorias.php"; 
            $db = categoria::staticConectar();
            $desplegable = categoria::desplegableCategorias($db);
            return $desplegable;
        }

        public function mostrarPrincipal(){
            require_once "models/productos.php";
            require_once "models/categorias.php"; 
            
        }
    }
?>