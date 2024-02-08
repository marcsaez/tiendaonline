<?php
    class ProductosController{
        public function listarProductos(){
            require_once "models/productos.php";
            require_once "models/categorias.php"; 
            $db = Productos::staticConectar();
            $allproducts = Productos::listarTodosProductos($db);
            include "views/admin/listarProductos.php";
        }
        public function anadirProducto(){
            require_once "models/productos.php";
            if(isset($_POST)){
                $longitudCategoria = 2;
                $longitudNombre = 2;
                $db = Productos::staticConectar();
                $numero = Productos::obtenerSiguienteNumeroProducto($db)+1;

                $codigoCategoria = substr(strtoupper($_POST['categoria']), 0, $longitudCategoria);
                $codigoNumero = str_pad($numero, 3, '0', STR_PAD_LEFT);
                $codigoNombre = substr(strtoupper($_POST['nombre']), 0, $longitudNombre);
                $codigoUnico = $codigoCategoria . $codigoNumero . '-' . $codigoNombre;

                $imagen_ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                $imagen_path = 'img/productos/' . $codigoUnico .'.'. $imagen_ext;
                move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen_path);
                

                $producto = new productos($codigoUnico,$_POST['nombre'], $_POST['descripcion'], $imagen_path, $_POST['stock'], isset($_POST['destacado']), $_POST['precio'], $_POST['categoria']);
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
                $imagen_ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                $imagen_path = 'img/productos/' . $_POST['id'] .'.'. $imagen_ext;
                move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen_path);

                $producto = new productos($_POST['id'],$_POST['nombre'], $_POST['descripcion'], $imagen_path, $_POST['stock'], isset($_POST['destacado']), $_POST['precio'], $_POST['categoria']);
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
                require_once "models/categorias.php";
                $idProducto = $_GET['id'];
                $db = Productos::staticConectar();
                // Obtener los detalles del producto con la ID especificada
                $productoDetalles = Productos::obtenerDetallesProducto($db, $idProducto);
                $productos = null;
                if (!empty($productoDetalles)) {
                    $categoryname = categoria::nombreCategorias($db, $productoDetalles[0]['fkcategories']);
                    $productoRetornado = $productoDetalles;
                    $desplegable = ProductosController::mostrarCategorias();
                    include "views/admin/editarProductos.php";
    
                } else {
                    $productoRetornado = null;
                }
            } else {
                $productoRetornado = null;
    
            }
        }
        public function paginaEditarAjax(){
            if (isset($_GET['id'])) {
                require_once "models/productos.php";
                $idProducto = $_GET['id'];
                $db = Productos::staticConectar();
                // Obtener los detalles del producto con la ID especificada
                $productoDetalles = Productos::obtenerDetallesProducto($db, $idProducto);
                $productos = null;
                if (!empty($productoDetalles)) {
                    $productoRetornado = $productoDetalles;
                    $desplegable = ProductosController::mostrarCategorias();
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
            $desplegable = categoria::navCategorias($db);
            return $desplegable;
        }

        public static function mostrarPrincipal(){
            require_once "models/productos.php";
            require_once "models/categorias.php"; 
            $db = Productos::staticConectar();
            $productosDestacados = Productos::productosDestacados($db);
            require_once "views/general/paginaPrincipal.php";
        }
        public function buscar() {
            require_once "models/productos.php";
            require_once "models/categorias.php";
        
            if (isset($_POST['termino'])) {
                $termino_busqueda = $_POST['termino'];
                $db = Productos::staticConectar();
                $resultados = Productos::buscadorProductos($db, $termino_busqueda);
                
                // Establecer el encabezado para indicar que se está enviando JSON
                header('Content-Type: application/json');
        
                // Imprimir la respuesta JSON
                echo json_encode($resultados);
                // No es necesario devolver nada aquí
            }
        }
        public function buscarPrincipal() {
            require_once "models/productos.php";
            require_once "models/categorias.php";
        
            if (isset($_POST['termino'])) {
                $termino_busqueda = $_POST['termino'];
                $db = Productos::staticConectar();
                $resultados = Productos::buscadorProductosPrincipal($db, $termino_busqueda);
                
                // Establecer el encabezado para indicar que se está enviando JSON
                header('Content-Type: application/json');
        
                // Imprimir la respuesta JSON
                echo json_encode($resultados);
                // No es necesario devolver nada aquí
            }
        }
        
        public static function productoConcreto(){
            require_once "models/productos.php";
            require_once "models/categorias.php"; 
            if(isset($_GET['productID'])){
                $id=$_GET['productID'];
                $db = Productos::staticConectar();
                $productoConcreto = Productos::productoConcreto($db,$id);
                $nombreCategoria = categoria::nombreCategorias($db,$productoConcreto[0]['fkcategories']);
                $masProds = Productos::masProductos($db,$productoConcreto[0]['fkcategories'],$productoConcreto[0]['productid']);
            }
            require_once "views/general/paginaProducto.php";
        }
        public static function paginaEliminar(){
            require_once "models/productos.php";
            if(isset($_GET['id'])){
                $id=$_GET['id'];
                $db = Productos::staticConectar();
                $productoBorrar = Productos::eliminarProducto($db,$id);
                if($productoBorrar == false){
                    echo "<meta http-equiv='refresh' content='0;url=index.php?Controller=Productos&action=listarProductos'>";
                }
                

            }
        }
        public static function contadoresProducts(){
            require_once "models/productos.php";
            require_once "models/categorias.php";
            $db = Productos::staticConectar();
            $categoriasActivas = Categoria::todasCategorias($db);
            $datos = [];
            foreach ($categoriasActivas as $categoria) {
                $contadorProduct = Productos::contadorProductosPorCategoria($db, $categoria);
                $nombreCategoria = Categoria::nombreCategorias($db,$categoria); // Asegúrate de usar el nombre de la clase con mayúscula inicial
                $datos[] = ['y' => $contadorProduct, 'label' => $nombreCategoria];
            }
            return $datos; // Devuelve los datos recopilados
        }
        
       
        
        
    }
?>