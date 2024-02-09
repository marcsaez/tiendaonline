<?php
//session_start();
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
            $stmt = $this->db->prepare("INSERT INTO cart(fkpurchase, fkproduct, amount, totalprice) VALUES ( :codigoCompra, :producto, :cantidad, :precioTotal)");
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
        $productosEnCarrito = [];
    
        foreach($arrayJson as $producto => $info){
            $idProducto = $info['id'];
            $cantidad = $info['cantidad'];
    
            $stmt = $db->prepare("SELECT productid, productname, productimg, productstock, productprice FROM products WHERE productid = :idProducto");
            $stmt->bindParam(':idProducto', $idProducto);
            $stmt->execute();
            $productoInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($productoInfo) {
                // Agregar la cantidad al array de información del producto
                $productoInfo['cantidad'] = $cantidad;
                $productosEnCarrito[] = $productoInfo;
            }
        }
        return $productosEnCarrito;
    }
    public static function comprobarPurchasesCliente($db, $userMail){
        try {
            $stmt = $db->prepare("SELECT purchaseid FROM purchases WHERE customeremail = :mail AND status = 0");
            $stmt->bindParam(':mail', $userMail);
            $stmt->execute();
            // Verificar si hay compras pendientes para el cliente
            if ($stmt->rowCount() == 0) {
                // No hay compras pendientes, realizar la inserción
                $fechaHoy = date("d-m-Y");
                $insertStmt = $db->prepare("INSERT INTO purchases (customeremail, creationdate) VALUES (:mail, :dia)");
                $insertStmt->bindParam(':mail', $userMail);
                $insertStmt->bindParam(':dia', $fechaHoy);
                $insertStmt->execute();
                $purchaseId = $db->lastInsertId();
            }else{
                $purchaseID = $stmt->fetch(PDO::FETCH_ASSOC);
                $purchaseID = $purchaseID['purchaseid'];
            }
        } catch (Exception $e) {
            echo "Error en la búsqueda de purchases: $e";
        }
        return $purchaseID;
    }
    public static function insertarPedido($db,$userMail,$pedidos,$idPurchase){
        try{
            foreach($pedidos as $pedido){
                $precioConjunto=$pedido['productprice']*$pedido['cantidad'];
                $stmt= $db->prepare("INSERT INTO cart (fkpurchase, fkproduct, amount, totalprice) VALUES (:idPurchase, :productID, :cantidad, :precioTotal)");
                $stmt->bindParam(':idPurchase', $idPurchase);
                $stmt->bindParam(':productID', $pedido['productid']);
                $stmt->bindParam(':cantidad', $pedido['cantidad']);
                $stmt->bindParam(':precioTotal', $precioConjunto);
                $stmt->execute();
            }
        }catch(Exception $e){
            echo "Error en la insercion del pedido: $e";
        }

    }
    
}
?>