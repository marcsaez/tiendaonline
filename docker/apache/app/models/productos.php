<?php
require_once("database.php");
class Productos extends database{
    private $idproducto;
    private $nombre;
    private $descripcion;
    private $imagen;
    private $stock;
    private $destacado;
    private $precio;
    private $categoria;

    public function __construct($idProducto,$nombre, $descripcion, $imagen, $stock, $destacado, $precio, $categoria) {
        $this->idproducto = $idProducto;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
        $this->stock = $stock;
        $this->destacado = $destacado;
        $this->precio = $precio;
        $this->categoria = $categoria;
    }
    //GETTERS Y SETTERS
    function getNombre() {
        return $this->nombre;
    }
    function getID() {
        return $this->idproducto;
    }
    function getDescripcion() {
        return $this->descripcion;
    }
    function getImg() {
        return $this->imagen;
    }
    function getStock() {
        return $this->stock;
    }
    function getDestacado() {
        return $this->destacado;
    }
    function getPrecio() {
        return $this->precio;
    }
    function getCategoria() {
        return $this->categoria;
    }
    function setID($id) {
        $this->idproducto = $id;
    }
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    function setImg($imagen) {
        $this->imagen = $imagen;
    }
    function setStock($stock) {
        $this->stock = $stock;
    }
    function setDestacado($destacado) {
        $this->destacado = $destacado;
    }
    function setPrecio($price) {
       $this->precio = $price;
    }
    function setCategoria($cat) {
        $this->categoria = $cat;
    }

    //FUNCIONES QUE EJECUTARA ESTA CLASE

    // Insertar producto
    public function anadir(){
        try{
            $categoria = $this->categoria;
            if($categoria){
                // Preparar la consulta con un marcador de posición (:categoria)
                $stmt2 = $this->db->prepare("SELECT categoryid FROM categories WHERE categoryname = :categoria");

                // Vincular el valor de $categoria al marcador de posición
                $stmt2->bindParam(':categoria', $categoria, PDO::PARAM_STR);

                // Ejecutar la consulta
                $stmt2->execute();

                // Obtener el resultado
                $result = $stmt2->fetch(PDO::FETCH_ASSOC);

                $stmt = $this->db->prepare("INSERT INTO products (productId, productName, productDescription, productImg, productStock, productNoted, productPrice, fkCategories) VALUES (:id, :nombre, :descripcion, :imagen, :stock, :destacado, :precio, :categoria)");
    
                if($this->destacado){
                    $destacado1 = 1;
                }else{
                    $destacado1 = 0;
                }
                $stmt->bindParam(':id', $this->idproducto);
                $stmt->bindParam(':nombre', $this->nombre);
                $stmt->bindParam(':descripcion', $this->descripcion);
                $stmt->bindParam(':imagen', $this->imagen);
                $stmt->bindParam(':stock', $this->stock);
                $stmt->bindParam(':destacado', $destacado1);
                $stmt->bindParam(':precio', $this->precio);
                $stmt->bindParam(':categoria', $result['categoryid']);
                $stmt->execute();
                $retorno = true;
            }    
        
        } catch (Exception $e){
            echo "error: $e";
            $retorno = false;
        }
        return $retorno;
    }
    public static function listarTodosProductos($db){
        
        try{
            $stmt = $db->prepare("SELECT * FROM products");
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $resultados = $stmt->fetchAll(PDO::FETCH_BOTH);
                for ($i=0; $i<count($resultados); $i++){
                    $resultados[$i]['fkcategories']= Categoria::nombreCategorias($db,$resultados[$i]['fkcategories']);
                }
            }
        }catch (Exception $e){
            $resultados = null;
        }
        return $resultados;
    }

    // Update Producte
    public function actualizarProducto() {
        try {
            if($this->imagen === null){
                $sql = "UPDATE products SET productName = :nombre, productDescription = :descripcion, productStock = :stock, productNoted = :destacado, productPrice = :precio, fkCategories = :categoria WHERE productid = :id";
                   
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':nombre', $this->nombre);
                $stmt->bindParam(':descripcion', $this->descripcion);
                $stmt->bindParam(':stock', $this->stock);
                $stmt->bindParam(':destacado',$this->destacado);
                $stmt->bindParam(':precio', $this->precio);
                $stmt->bindParam(':categoria', $this->categoria);
                $stmt->bindParam(':id', $this->idproducto);
                $stmt->execute();
                $retorno = true;
            }else{
                    $sql = "UPDATE products SET productName = :nombre, productDescription = :descripcion, productImg = :imagen, productStock = :stock, productNoted = :destacado, productPrice = :precio, fkCategories = :categoria WHERE productid = :id"; 
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':nombre', $this->nombre);
                $stmt->bindParam(':descripcion', $this->descripcion);
                $stmt->bindParam(':imagen', $this->imagen);
                $stmt->bindParam(':stock', $this->stock);
                $stmt->bindParam(':destacado',$this->destacado);
                $stmt->bindParam(':precio', $this->precio);
                $stmt->bindParam(':categoria', $this->categoria);
                $stmt->bindParam(':id', $this->idproducto);
                $stmt->execute();
                $retorno = true;
                }
            
            
            } catch (Exception $e) {
                // Manejar la excepción (mostrar un mensaje de error, registrar, etc.)
                echo "Error al actualizar producto: " . $e->getMessage();
                $retorno = false;
            }
            return $retorno;
    }

    // Obtener productos
    public static function obtenerDetallesProducto($db,$idProducto) {
        $stmt = $db->prepare("SELECT * FROM products WHERE productid = :id");
        $stmt->bindParam(':id', $idProducto);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $resultados;
    }
    
    //Obtener productos con la misma subcategoria para hacer display en la pagina de producto
    public static function masProductos($db,$subcategoria,$idProducto){
        try{
            $stmt = $db->prepare("SELECT * FROM products WHERE fkcategories = :subcategoria AND active = 1 AND productid != :idproducto ORDER BY random() LIMIT 6;");
            $stmt->bindParam(':subcategoria',  $subcategoria);
            $stmt->bindParam(':idproducto',$idProducto);
            $stmt->execute();
            $masProductos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $masProductos;
        }catch (Excepction $e){
            echo"Error en la obtencion de productos similares" . $e->getMessage();
        }
    }
    public static function productosDestacados($db){
        try{
            $stmt = $db->prepare("SELECT productid, productname, productimg, productprice, productdescription FROM products WHERE productnoted = 1 AND active = 1 LIMIT 3;");
            $stmt->execute();
            $productosDestacados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $productosDestacados;
        }catch (Excepction $e){
            echo"Error en la obtencion de productos similares" . $e->getMessage();
        }
    }
    public static function productoConcreto($db, $idproducto){
        try{
            $stmt =$db->prepare("SELECT * FROM products WHERE productid = :idproducto;");
            $stmt->bindParam(':idproducto', $idproducto);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $productoConcreto = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $productoConcreto = null;
            }
        }catch (Excepction $e){
            echo"Error en la obtencion de productos similares" . $e->getMessage();
            $productoConcreto = null;
        }
        return $productoConcreto;
    }
    public static function buscadorProductos($db, $termino_busqueda){
        try{
            $stmt = $db->prepare("SELECT * FROM products WHERE LOWER(productname) LIKE LOWER(:termino_busqueda)");
            $stmt->bindValue(':termino_busqueda', '%' . $termino_busqueda . '%', PDO::PARAM_STR);
            $stmt->execute();
           
            if($stmt->rowCount() > 0){
                $resultados = $stmt->fetchAll(PDO::FETCH_BOTH);
                foreach ($resultados as &$fila) {
                    $fila['fkcategories'] = Categoria::nombreCategorias($db, $fila['fkcategories']);
                }
                
            
            }
        }catch (Exception $e){
            $resultados = null;
        }
        return $resultados;
    }
    public static function buscadorProductosPrincipal($db, $termino_busqueda){
        try{
            $stmt = $db->prepare("SELECT * FROM products WHERE LOWER(productname) LIKE LOWER(:termino_busqueda) AND active = 1");
            $stmt->bindValue(':termino_busqueda', '%' . $termino_busqueda . '%', PDO::PARAM_STR);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }catch (Exception $e){
            $resultados = null;
        }
        return $resultados;
    }
    public static function obtenerSiguienteNumeroProducto($db) {
        try{
            $stmt = $db->prepare("SELECT COUNT(*) as total FROM products");
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $siguienteNumero = $stmt->fetchColumn();
            }
        }catch (Exception $e){
            $siguienteNumero = 0;
        }
        return $siguienteNumero;
    }
    public static function obtenerRutasImagenes($db) {
        try{
            $stmt = $db->prepare("SELECT ruteimage FROM sliderimages");
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $rutasSlider = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }catch (Exception $e){
            $rutasSlider = 0;
        }
        return $rutasSlider;  
    }
    public static function eliminarProducto($db,$id,$activo){
        if($activo == 1){
            try{
                $stmt =$db->prepare("UPDATE products SET active = 0 WHERE productid = :idproducto;");
                $stmt->bindParam(':idproducto', $id);
                $stmt->execute();
                $error = false;
            } catch(Exception $e){
                $error = true;
            }
        } else{
            try{
                $stmt =$db->prepare("UPDATE products SET active = 1 WHERE productid = :idproducto;");
                $stmt->bindParam(':idproducto', $id);
                $stmt->execute();
                $error = false;
            } catch(Exception $e){
                $error = true;
            }
        }
        
        return $error;
    }
    public static function contadorProductosPorCategoria($db, $categoria){
        try{
            $stmt =$db->prepare("SELECT COUNT(*) FROM products WHERE fkcategories = :categoria ");
            $stmt->bindParam(':categoria', $categoria, PDO::PARAM_INT);
            $stmt->execute();

            $count = $stmt->fetchColumn();
            
        } catch (Exception $e){
            $count = true;
        }
        return $count;

    }
    public static function sumarProductos($db, $categoria){
        try{
            $stmt =$db->prepare("SELECT SUM(productstock) FROM products WHERE fkcategories = :categoria");
            $stmt->bindParam(':categoria', $categoria, PDO::PARAM_INT);
            $stmt->execute();

            $suma = $stmt->fetchColumn();
            
        } catch (Exception $e){
            $suma = true;
        }
        return $suma;

    }
}
?>