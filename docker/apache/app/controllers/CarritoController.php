<?php
    class CarritoController{
        public function insertarProductos(){
            require_once "models/carrito.php";
            $db = Carrito::staticConectar();
        }
        public function obtenerDatosProductosCarrito($data){
            require_once "models/carrito.php";
            $db = Carrito::staticConectar();
            $productos = Carrito::productosDelCarrito($db, $data);
            require_once "../views/general/carrito.php";
        }
    }
    $controlador = new CarritoController();
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Recuperar datos del cuerpo de la solicitud
        $data = json_decode(file_get_contents("php://input"), true);
        // Verificar si se proporcionó una acción y llamar a la función correspondiente
        $controlador->obtenerDatosProductosCarrito($data);
    } else {
        echo json_encode(array("error" => "Solicitud no válida"));
    }

?>