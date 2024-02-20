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
        $purchaseID=null;
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
    public static function cambiarStatusCompra($db, $purchaseID, $costoTotal){
        $return = false;
        try{
            $stmt=$db->prepare("UPDATE purchases SET status = :status, totalcost = :costoFinal WHERE purchaseid =:purchaseID");
            $status=1;
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':costoFinal', $costoTotal);
            $stmt->bindParam(':purchaseID', $purchaseID);
            $stmt->execute();
            $return=true;
        }catch(Exception $e){
            echo "Error en el cambio del  status del purchase: $e";
        }
        return $return;
    }
    public static function deletearProductoPurchase($db, $productID, $purchaseID){
        try{
            $stmt = $db->prepare("DELETE FROM cart WHERE fkpurchase = :purchaseid AND fkproduct = :productid; ");
            $stmt->bindParam(':purchaseid', $purchaseID);
            $stmt->bindParam(':productid', $productID);
            $stmt->execute();
        }catch(Exception $e){
            echo "Error en la eliminacion del producto: $e";
        }
    }
    public static function deletePedido($db, $productID, $customermail){
        try {
            $query = "SELECT purchaseid FROM purchases WHERE status = 0 AND customermail = :customermail ORDER BY creationdate DESC LIMIT 1";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':customermail', $customermail);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $purchaseID = $result['purchaseid'];
                $stmtDelete = $db->prepare("DELETE FROM cart WHERE fkproduct = :product AND fkpurchase = :purchaseID");
                $stmtDelete->bindParam(':purchaseID', $purchaseID);
                $stmt->bindParam(':fkproduct', $productID);
                $stmtDelete->execute();
            } else {
                echo "No se encontró ningún pedido para el cliente con el correo electrónico proporcionado.";
            }
        } catch (PDOException $e) {
            echo "Error en la eliminación del pedido: " . $e->getMessage();
        }
    }

    public static function obtenerDatosCarrito($db, $email){
        
        $sql = "SELECT cart.*, products.* 
                FROM cart 
                JOIN products ON cart.fkproduct = products.productid 
                WHERE cart.fkpurchase = (
                    SELECT purchaseid 
                    FROM purchases
                    WHERE status = 0 AND customeremail LIKE :email
                    ORDER BY creationdate DESC
                    LIMIT 1
                )";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $datos_carrito = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $datos_carrito;
    }
    
    
}
?>