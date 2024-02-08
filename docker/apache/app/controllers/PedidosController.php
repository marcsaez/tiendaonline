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
            if(isset($_GET)){
                $id = $_GET['idpedido'];
                echo "$id";
            }

        }

    }


?>