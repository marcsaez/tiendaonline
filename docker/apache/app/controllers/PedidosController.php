<?php
    class PedidosController{
        public function listarPedidos(){
            require_once "models/pedidos.php";
            $db = Pedido::staticConectar();
            $pendientes = Pedido::listarPedidosPendientes($db);
            print_r($pendientes);
            require_once "views/admin/listarCategorias.php";
        }

    }


?>