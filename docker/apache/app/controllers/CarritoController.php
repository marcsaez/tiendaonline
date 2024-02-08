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
            require_once 'views/general/carrito.php';
        }
        public function insertarPedidos(){
            
        }
        public function abrirCarrito(){
            require_once 'views/general/carrito.php';
        }
    }
    $controlador = new CarritoController();
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Recuperar datos del cuerpo de la solicitud
        $_SESSION['carrito'] = json_decode(file_get_contents("php://input"), true);
        //Verificar si se proporcionó una acción y llamar a la función correspondiente
        $controlador->obtenerDatosProductosCarrito($_SESSION['carrito']);
    } else {
        echo json_encode(array("error" => "Solicitud no válida"));
    }
    
     //FUNCION PARA CREAR UN PEDIDO DESPUES DE EJECUTAR COMPRA
?>