<?php
 require_once "models/carrito.php";
 class CarritoController{
        public function obtenerDatosProductosCarrito(){ 
            ob_clean();
            header("Content-Type: application/json");
            $datos = json_decode(file_get_contents("php://input"), true);
            $datos=implode(" ",$datos);
            $db = Carrito::staticConectar();
            $_SESSION['carrito'] = Carrito::productosDelCarrito($db, $datos);
            $this->insertarPurchases();
        }
        public function abrirCarrito(){
            $db = Carrito::staticConectar();
            if (isset($_SESSION['userMail'])) {
                $email = $_SESSION['userMail'];
                $datosCarrito = Carrito::obtenerDatosCarrito($db, $email);
            }
            require_once 'views/general/carrito.php';
        }
        public function abrirCarritoNoLog(){
            require_once 'views/general/carritoNoLog.php';
        }
        public function procesarCompra(){
            $db=Carrito::staticConectar();
            $ejecutarCompra=Carrito::cambiarStatusCompra($db, $_POST['purchaseIDFK'], $_POST['costoTotalCompra']);
            if($ejecutarCompra==true){
                $idPurchase = Carrito::comprobarPurchasesCliente($db, $_SESSION['userMail']);         
            }
            echo'<meta http-equiv="refresh" content="0; url=index.php">';
        }
        public function obtenerDatosProductosCarritoDos(){ 
            ob_clean();
            header("Content-Type: application/json");
            $datos = json_decode(file_get_contents("php://input"), true);
            $datos=implode(" ",$datos);
            $db = Carrito::staticConectar();
            $carrito = Carrito::productosDelCarrito($db, $datos);
            $this->insertarPurchases2($carrito);
        }
        public function deletePurchase(){
            $db = Carrito::staticConectar();
            $delete = Carrito::deletearProductoPurchase($db, $_GET['productIDdelete'], $_GET['purchaseIDdelete']);
            $this->abrirCarrito();
        }
        public function insertarPurchases(){
            $db = Carrito::staticConectar();
            $idPurchase = Carrito::comprobarPurchasesCliente($db, $_SESSION['userMail']);         
            foreach($_SESSION['carrito'] as $pedido){
                $precioConjunto = $pedido['productprice'] * $pedido['cantidad'];
                // Comprobar si ya existe una entrada para este producto en esta compra
                $stmt_check = $db->prepare("SELECT COUNT(*) as count FROM cart WHERE fkpurchase = :idPurchase AND fkproduct = :productID");
                $stmt_check->bindParam(':idPurchase', $idPurchase);
                $stmt_check->bindParam(':productID', $pedido['productid']);
                $stmt_check->execute();
                $result = $stmt_check->fetch(PDO::FETCH_ASSOC);
                if($result['count'] > 0) {
                    // Si existe, actualizar la cantidad
                    $stmt_update = $db->prepare("UPDATE cart SET amount = amount + :cantidad, totalprice = totalprice + :precioTotal WHERE fkpurchase = :idPurchase AND fkproduct = :productID");
                    $stmt_update->bindParam(':idPurchase', $idPurchase);
                    $stmt_update->bindParam(':productID', $pedido['productid']);
                    $stmt_update->bindParam(':cantidad', $pedido['cantidad']);
                    $stmt_update->bindParam(':precioTotal', $precioConjunto);
                    try{
                        $stmt_update->execute();
                    } catch(Exception $e){
                        echo "$e";
                    }
                } else {
                    // Si no existe, insertar una nueva entrada
                    $stmt_insert = $db->prepare("INSERT INTO cart (fkpurchase, fkproduct, amount, totalprice) VALUES (:idPurchase, :productID, :cantidad, :precioTotal)");
                    $stmt_insert->bindParam(':idPurchase', $idPurchase);
                    $stmt_insert->bindParam(':productID', $pedido['productid']);
                    $stmt_insert->bindParam(':cantidad', $pedido['cantidad']);
                    $stmt_insert->bindParam(':precioTotal', $precioConjunto);
                    try{
                        $stmt_insert->execute();
                    } catch(Exception $e){
                        echo "$e";
                    }
                }
            }
        }
        public function insertarPurchases2($carrito){
            $db = Carrito::staticConectar();
            $idPurchase = Carrito::comprobarPurchasesCliente($db, $_SESSION['userMail']);         
            foreach($carrito as $pedido){
                $precioConjunto = $pedido['productprice'] * $pedido['cantidad'];
                // Comprobar si ya existe una entrada para este producto en esta compra
                $stmt_check = $db->prepare("SELECT COUNT(*) as count FROM cart WHERE fkpurchase = :idPurchase AND fkproduct = :productID");
                $stmt_check->bindParam(':idPurchase', $idPurchase);
                $stmt_check->bindParam(':productID', $pedido['productid']);
                $stmt_check->execute();
                $result = $stmt_check->fetch(PDO::FETCH_ASSOC);
                if($result['count'] > 0) {
                    // Si existe, actualizar la cantidad
                    $stmt_update = $db->prepare("UPDATE cart SET amount = amount + :cantidad, totalprice = totalprice + :precioTotal WHERE fkpurchase = :idPurchase AND fkproduct = :productID");
                    $stmt_update->bindParam(':idPurchase', $idPurchase);
                    $stmt_update->bindParam(':productID', $pedido['productid']);
                    $stmt_update->bindParam(':cantidad', $pedido['cantidad']);
                    $stmt_update->bindParam(':precioTotal', $precioConjunto);
                    try{
                        $stmt_update->execute();
                    } catch(Exception $e){
                        echo "$e";
                    }
                } else {
                    // Si no existe, insertar una nueva entrada
                    $stmt_insert = $db->prepare("INSERT INTO cart (fkpurchase, fkproduct, amount, totalprice) VALUES (:idPurchase, :productID, :cantidad, :precioTotal)");
                    $stmt_insert->bindParam(':idPurchase', $idPurchase);
                    $stmt_insert->bindParam(':productID', $pedido['productid']);
                    $stmt_insert->bindParam(':cantidad', $pedido['cantidad']);
                    $stmt_insert->bindParam(':precioTotal', $precioConjunto);
                    try{
                        $stmt_insert->execute();
                    } catch(Exception $e){
                        echo "$e";
                    }
                }
            }
        }
        public function enviarPedido(){
            if (isset($_POST)){
                require_once "models/compra.php";
                $db = Carrito::staticConectar();
                $id = $_POST['id'];
                compra::enviarPedido($db, $id);
                echo '<meta http-equiv="refresh" content="0;url=index.php?Controller=Pedidos&action=listarPedidos">';
            }
        }
        
    }
?>