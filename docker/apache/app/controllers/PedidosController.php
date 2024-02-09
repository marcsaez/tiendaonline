<?php
    class PedidosController{
        public function listarPedidos(){
            require_once "models/pedidos.php";
            $db = Pedido::staticConectar();
            $pendientes = Pedido::listarPedidosPendientes($db);
            $finalizados = Pedido::listarPedidosFinalizados($db);
            require_once "views/admin/listarPedidos.php";
        }
        public function detallePedido(){
            require_once "models/pedidos.php";
            require_once "models/usuario.php";
            if(isset($_GET)){
                $id = $_GET['idpedido'];
                $email = $_GET['email'];
                $totalcost = $_GET['totalcost'];
                $db = Pedido::staticConectar();
                $result = Pedido::listarDetallesPedido($db,$id);
                $productsInfo = Pedido::listarDetallesProductos($db, $result);
                $datosCustomer = Usuario::detallesUser($db, $email);
                require_once "views/admin/listarDetallesPedidos.php";

            }

        }

    }


?>