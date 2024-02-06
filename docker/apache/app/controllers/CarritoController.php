<?php
 header("Content-Type: application/json");
 require_once "../models/carrito.php";
    class CarritoController{
        public function insertarProductos(){
            $db = Carrito::staticConectar();
        }
        public function obtenerDatosProductosCarrito($data){ 
            print_r($_SESSION); 
            $db = Carrito::staticConectar();
            $productos = Carrito::productosDelCarrito($db, $data);
        }
        public function abrirCarrito(){
            require_once './views/general/carrito.php';
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
?>