<?php
 require_once "models/carrito.php";
 class CarritoController{
     public function insertarProductos(){
         $db = Carrito::staticConectar();
        }
        public function obtenerDatosProductosCarrito(){ 
            ob_clean();
            header("Content-Type: application/json");
            $datos = json_decode(file_get_contents("php://input"), true);
            $datos=implode(" ",$datos);
            $db = Carrito::staticConectar();
            $_SESSION['carrito'] = Carrito::productosDelCarrito($db, $datos);
            
            echo json_encode(['succes' => true, 'info' => $datos]);
            exit;

        }
        public function insertarPedidos(){
            
        }
        public function abrirCarrito(){
            require_once 'views/general/carrito.php';
        }
    }
?>