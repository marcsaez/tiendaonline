<?php
    class CategoriasController{
        public function listarCategorias(){
            require_once "models/categorias.php";
            $db = Categoria::staticConectar();
            $allcategories = Categoria::listarTodasCategorias($db);
            $padres = array();
            foreach ($allcategories as $category) {
                if (empty($category['fkfathercategory'])) {
                    $padres[] = $category;
                }
            }
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
                // if ($allcategories){
                    ?>
                    <!-- <script>
                        alert("Producto creado correctamente");
                    </script> -->
                    <?php
                //     header("Location: index.php?Controller=Categorias&action=listarCategorias");
                // } else{
                    ?>
                    <!-- <script>
                        alert("Error en alguno de los datos");
                    </script> -->
                    <?php
                    echo '<meta http-equiv="refresh" content="0;url=index.php?Controller=Categorias&action=listarCategorias">';
                }
        }   
        public function editarCategoria(){
            if(isset($_POST)){
                require_once "models/categorias.php";
                $categoria = new categoria($_POST['id'], $_POST['nombre'], $_POST['categoriaPadre']);
                $categoria -> conectar();
                $editada = $categoria -> editar();
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
                    echo '<meta http-equiv="refresh" content="0;url=index.php?Controller=Categorias&action=listarCategorias">';
                }else{
                    echo $actualizada;
                    sleep(5);
                    echo '<meta http-equiv="refresh" content="0;url=index.php?Controller=Categorias&action=listarCategorias">';
                }
            } else {
                // Si no se proporciona 'id' en la URL, muestra un mensaje de error o realiza otra acción
                echo "Error: ID de categoría no proporcionado en la URL";
            }
        }

        public function filtrar(){
            if (isset($_GET['categoria'])){
                $id = $_GET['categoria'];
                $nombre = $_GET['nombre'];
                require_once "models/categorias.php";
                $db = Categoria::staticConectar();
                $result = Categoria::filtroCategorias($db,$id);
                $subcat = $result[0];
                $products = $result[1];
                require_once "views/general/filtroCategorias.php";
                
            }
        }
        public function buscar() {
            require_once "models/categorias.php";
            if (isset($_POST['termino'])) {
                $termino_busqueda = $_POST['termino'];
                $db = Categoria::staticConectar();
                $resultados = Categoria::buscadorCategorias($db, $termino_busqueda);
                
                // Establecer el encabezado para indicar que se está enviando JSON
                header('Content-Type: application/json');
        
                // Imprimir la respuesta JSON
                echo json_encode($resultados);
                // No es necesario devolver nada aquí
            }
        }

    }
    
?>