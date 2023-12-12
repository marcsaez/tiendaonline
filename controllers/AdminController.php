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
        public function listarProductos(){
            require_once "views/admin/listarProductos.php";
            require_once "models/productos.php";
            $producto = new productos();
            $producto->conectar();
            $allproducts = $producto->listarTodosProductos();
        }
        public function anadirProducto(){
            if(isset($_POST)){
                require_once "models/productos.php";
                $producto = new productos();
                $producto->conectar();
                $allproducts = $producto->anadir($_POST['idProducto'],$_POST['nombre'], $_POST['descripcion'], $_POST['imagen'], $_POST['stock'], isset($_POST['destacado']), $_POST['precio'], $_POST['categoria']);
                if ($allproducts){
                    ?>
                    <script>
                        alert("Producto creado correctamente");
                    </script>
                    <?php
                    header("Location: index.php?Controller=Admin&action=listarProductos");
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
            require_once "views/admin/anadirProductos.php";
        }
        public function paginaEditar(){
            if (isset($_GET['id'])) {
                require_once "models/productos.php";
                $idProducto = $_GET['id'];
                $producto = new productos();
                $producto->conectar();
                // Obtener los detalles del producto con la ID especificada
                $productoDetalles = $producto->obtenerDetallesProducto($idProducto);
                $productos = null;
                foreach ($productoDetalles as $productos) {
                    // Acceder a los campos del producto
                    $idproduct = $productos['productid'];
                    $nombre = $productos['productname'];
                    $descripcion = $productos['productdescription'];
                    $imagen = $productos['productimg'];
                    $stock = $productos['productstock'];
                    $destacado = $productos['productnoted'];
                    $precio = $productos['productprice'];
                    $categoria = $productos['fkcategories'];
                    }
                if ($producto) {
                    // Renderizar la vista de edición con los detalles del producto
                    require_once "views/admin/editarProductos.php";
                } else {
                    echo "Producto no encontrado.";
                }
            } else {
                echo "ID del producto no especificada.";
            }
        }
        public function editarProductos(){
            if(isset($_POST)){
                require_once "models/productos.php";
                $producto = new productos();
                $producto->conectar();
                $allproducts = $producto->actualizarProducto($_POST['id'],$_POST['nombre'], $_POST['descripcion'], $_POST['imagen'], $_POST['stock'], isset($_POST['destacado']), $_POST['precio'], $_POST['categoria']);
                if ($allproducts){
                    ?>
                    <script>
                        alert("Producto editado correctamente");
                    </script>
                    <?php
                    header("Location: index.php?Controller=Admin&action=listarProductos");
                    
                } else{
                    ?>
                    <script>
                        alert("Error en el editado de los datos");
                    </script>
                    <?php
                    require_once "views/admin/editarProductos.php";
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