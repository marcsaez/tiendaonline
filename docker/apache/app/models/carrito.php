<?php
require_once("database.php");
class Carrito extends database{
    private $codigoCompra;
    private $producto;
    private $cantidad;
    private $precioTotal;

    public function __construct($codigocompra, $producto, $cantidad, $preciototal) {
        $this->codigoCompra = $codigocompra;
        $this->producto = $producto;
        $this->cantidad = $cantidad;
        $this->precioTotal=$preciototal;
    }
    //GETTERS Y SETTERS
    function getCodigoCompra() {
        return $this->codigocompra;
    }
    function getProducto() {
        return $this->producto;
    }
    function getCantidad() {
        return $this->cantidad;
    }
    function getPrecioTotal() {
        return $this->preciototal;
    }
    function setCodigoCompra($codigo) {
        $this->codigocompra = $codigo;
    }
    function setProducto($product) {
        $this->producto = $product;
    }
    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }
    function setPrecioTotal($total) {
        $this->preciototal = $total;
    }
    //FUNCIONES QUE EJECUTARA ESTA CLASE
    //Funcion que obtiene el id de la compra que ejecutará el usuario. Es provisonal y requerira de cambios.
    //Para ello, habrá que crear una entrada vacia que guarde el id del usuario que va a realizar la compra y genere la id de la compra para poder ir guardando los productos. 
    //Si el usuario no terminara ejecutando la compra, se borrará la entrada para no sobrecargar la base de datos.
    public function obtenerIDCompra(){
        try {
            $stmt = $this->db->prepare("SELECT MAX(purchaseid) AS ultimo_purchaseid FROM purchases;");
            $stmt->execute();
            // Obtener el resultado de la consulta
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verificar si se obtuvo un resultado
            if ($resultado !== false && isset($resultado['ultimo_cartid'])) {
                // Guardar el resultado en la variable $IDCompra
                $IDCompra = $resultado['ultimo_cartid'];
            } else {
                // Si no se obtuvo un resultado válido
                $IDCompra = null;
            }    
        } catch (Exception $e) {
            // Manejar cualquier excepción que pueda ocurrir durante la ejecución de la consulta
            echo "Error: " . $e->getMessage();
            $IDCompra = null;
        }
        return $IDCompra;
    }
    public function anadirPedido(){
        try{
            $stmt = $this->db->prepare("INSERT INTO cart(fkpurchase, fkproduct, amount, totalprice) VALUES (:codigoCompra, :producto, :cantidad, :precioTotal)");
            $stmt->bindParam(':codigoCompra',$this->codigoCompra);
            $stmt->bindParam(':producto',$this->producto);
            $stmt->bindParam(':cantidad',$this->cantidad);
            $stmt->bindParam(':precioTotal',$this->precioTotal);
            $stmt->execute();
            $retorno = true;    
        } catch (Exception $e){
            echo "error: $e";
            $retorno = false;
        }
        return $retorno;
    }
    public static function productosDelCarrito($db, $diccionario){
        $arrayJson = json_decode($diccionario, true);
        $arrayIds = [];
        foreach($arrayJson as $producto => $info){
            $arrayIds[]=$info['id'];
        }
        $productosEnCarrito = [];
        foreach($arrayIds as $idProducto){
            $stmt = $db -> prepare("SELECT productname, productimg, productstock, productprice FROM products WHERE productid = :idProducto");
            $stmt->bindParam(':idProducto', $idProducto);
            $stmt->execute();
            $productoInfo = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($productoInfo) {
                $productosEnCarrito[] = $productoInfo;
            }
        }
        return $productosEnCarrito;
    }
    
}
?>