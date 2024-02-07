<?php
 require_once "../models/carrito.php";
 class CarritoController{
     public function insertarProductos(){
         $db = Carrito::staticConectar();
        }
        public function obtenerDatosProductosCarrito(){ 
            ob_clean();
            header("Content-Type: application/json");
            $_SESSION['carrito'] = json_decode(file_get_contents("php://input"), true);

            print_r($_SESSION); 
            $db = Carrito::staticConectar();
            $productos = Carrito::productosDelCarrito($db, $_SESSION['carrito']);
            require_once 'views/general/carrito.php';
        }
        public function abrirCarrito(){
            require_once './views/general/carrito.php';
        }
    }
    
    // $controlador = new CarritoController();
    // if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //     // Recuperar datos del cuerpo de la solicitud
    //     echo "HOLALALALLAL";
    //     session_start();
    //     print_r($_SESSION);
        
    //     //Verificar si se proporcionó una acción y llamar a la función correspondiente
    //     $controlador->obtenerDatosProductosCarrito($_SESSION['carrito']);
    // } else {
    //     echo json_encode(array("error" => "Solicitud no válida"));
    // }

?>