<?php
require_once("database.php");
class productos extends database{
    private $idproducto;
    private $nombre;
    private $descripcion;
    private $Imagen;
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
        return $this->Imagen;
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
    function setImg($Imagen) {
        $this->Imagen = $Imagen;
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
                $stmt->bindParam(':imagen', $this->Imagen);
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
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }catch (Exception $e){
            $resultados = null;
        }
        return $resultados;
    }

    // Update Producte
    public function actualizarProducto() {
        try {

            $sql = "UPDATE products SET productName = :nombre, productDescription = :descripcion, productImg = :imagen, productStock = :stock, productNoted = :destacado, productPrice = :precio, fkCategories = :categoria WHERE productid = :id";
            if($this->destacado){
                $destacado1 = 1;
            }else{
                $destacado1 = 0;
            }   
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':descripcion', $this->descripcion);
            $stmt->bindParam(':imagen', $this->Imagen);
            $stmt->bindParam(':stock', $this->stock);
            $stmt->bindParam(':destacado', $destacado1);
            $stmt->bindParam(':precio', $this->precio);
            $stmt->bindParam(':categoria', $this->categoria);
            $stmt->bindParam(':id', $this->idproducto);
            $stmt->execute();
            $retorno = true;
            
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
    public function masProductos($subcategoria){
        try{
            $stmt = $this->db->prepare("SELECT productname, productimg, productprice FROM products WHERE fkcategories = :subcategoria ORDER BY random() LIMIT 6;");
            $stmt->bindParam(':subcategoria', $subcategoria);
            $stmt->execute();
            $masProductos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $masProductos;
        }catch (Excepction $e){
            echo"Error en la obtencion de productos similares" . $e->getMessage();
        }
    }
    public static function productosDestacados(){
        try{
            $stmt = $this->db->prepare("SELECT productname, productimg, productprice, productdescription FROM products WHERE productnoted = 1 LIMIT 4;");
            $stmt->execute();
            $productosDestacados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $productosDestacados;
        }catch (Excepction $e){
            echo"Error en la obtencion de productos similares" . $e->getMessage();
        }
    }
}
?>