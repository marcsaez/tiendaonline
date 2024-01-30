<?php
    class CarritoController{
        public function insertarProductos(){
            require_once "models/carrito.php";
            $db = Carrito::staticConectar();
        }
    }
    $controlador = new CarritoController();
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Recuperar datos del cuerpo de la solicitud
        $data = json_decode(file_get_contents("php://input"), true);
        // Verificar si se proporcionó una acción y llamar a la función correspondiente
        require_once "../views/general/carrito.php";
    } else {
        echo json_encode(array("error" => "Solicitud no válida"));
    }
?>