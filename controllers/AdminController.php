<?php
    class AdminController{
        public function Login(){
            if(isset($_POST)){
                require_once "models/cliente.php";
                $cliente = new cliente();
                $cliente->conectar();
                $todosLosUsuarios = $cliente->iniciarSesion($_POST['usuario'], $_POST['password']);
                 if($todosLosUsuarios == true){
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
        public function añadirProducto(){
            if(isset($_POST)){
                require_once "models/productos.php";
                $producto = new productos();
                $producto->conectar();
                $allproducts = $producto->añadir($_POST['idProducto'],$_POST['nombre'], $_POST['descripcion'], $_POST['imagen'], $_POST['stock'], isset($_POST['destacado']), $_POST['precio'], $_POST['categoria']);
                if ($allproducts){
                    ?>
                    <script>
                        alert("Producto creado correctamente");
                    </script>
                    <?php
                    require_once "views/admin/listarProductos.php";
                } else{
                    ?>
                    <script>
                        alert("Error en alguno de los datos");
                    </script>
                    <?php
                    require_once "views/admin/añadirProductos.php";
                }
            }
        }
        public function paginaAñadirProductos(){
            require_once "views/admin/añadirProductos.php";
        }
        public function paginaEditar(){
            require_once "views/admin/editarProductos.php";
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
                    require_once "views/admin/listarProductos.php";
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
    }
?>