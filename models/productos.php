<?php
require_once("database.php");
class productos extends database{
    private $nombre;
    private $descripcion;
    private $Imagen;
    private $stock;
    private $destacado;
    private $precio;
    private $categoria;

    //GETTERS Y SETTERS
    function getNombre() {
        return $this->nombre;
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
    public function añadir($id,$nombre, $descripcion, $imagen, $stock, $destacado, $precio, $categoria){
        try{    
        $stmt = $this->db->prepare("INSERT INTO products (productId, productName, productDescription, productImg, productStock, productNoted, productPrice, fkCategories) VALUES (:id, :nombre, :descripcion, :imagen, :stock, :destacado, :precio, :categoria)");
    
            if($destacado){
                $destacado1 = 1;
            }else{
                $destacado1 = 0;
            }
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':imagen', $imagen);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':destacado', $destacado1);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->execute();
            return true;
        } catch (Exception $e){
            echo "error: $e";
            return false;
        }
    }
    public function listarTodosProductos(){
        try{
            $stmt = $this->db->prepare("SELECT * FROM products");
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Recorrer los resultados con un foreach
            foreach ($resultados as $producto) {
                // Acceder a los campos del producto
                $idproduct = $producto['$productid'];
                $nombre = $producto['productname'];
                $descripcion = $producto['productdescription'];
                $imagen = $producto['productimg'];
                $stock = $producto['productstock'];
                $destacado = $producto['productnoted'];
                $precio = $producto['productprice'];
                $categoria = $producto['fkcategories'];

                //FALTARA AÑADIR EL RESTO DE COSAS
                echo "<p>$nombre, $descripcion <a href = index.php?Controller=Admin&action=paginaEditar&id=".$idproduct."'><img src='img/editar.png' alt='Editar'></a></p>";
            }
            }
            return true;
        }catch (Exception $e){
            return false;
        }
    }
    public function actualizarProducto($id, $nuevoNombre, $nuevaDescripcion, $nuevaImagen, $nuevoStock, $nuevoDestacado, $nuevoPrecio, $nuevaCategoria) {
        try {

            $sql = "UPDATE products SET productName = :nombre, productDescription = :descripcion, productImg = :imagen, productStock = :stock, productNoted = :destacado, productPrice = :precio, fkCategories = :categoria WHERE productid = :id";
            if($nuevoDestacado){
                $destacado1 = 1;
            }else{
                $destacado1 = 0;
            }   
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nombre', $nuevoNombre);
            $stmt->bindParam(':descripcion', $nuevaDescripcion);
            $stmt->bindParam(':imagen', $nuevaImagen);
            $stmt->bindParam(':stock', $nuevoStock);
            $stmt->bindParam(':destacado', $destacado1);
            $stmt->bindParam(':precio', $nuevoPrecio);
            $stmt->bindParam(':categoria', $nuevaCategoria);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        
            return true;
            } catch (Exception $e) {
                // Manejar la excepción (mostrar un mensaje de error, registrar, etc.)
                echo "Error al actualizar producto: " . $e->getMessage();
                return false;
            }
        
        
    }
}
?>