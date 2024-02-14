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
            $datosCarrito = Carrito::obtenerDatosCarrito($db);

            require_once 'views/general/carrito.php';
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
        
    }
?>