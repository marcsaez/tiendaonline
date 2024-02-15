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
                $valor = $_GET['valor'];
                $db = Pedido::staticConectar();
                $result = Pedido::listarDetallesPedido($db,$id);
                $productsInfo = Pedido::listarDetallesProductos($db, $result);
                foreach ($result as $key => $value) {
                    if (isset($productsInfo[$key][0]['productname'])) {
                        $result[$key]['productname'] = $productsInfo[$key][0]['productname'];
                    } else {
                        $result[$key]['productname'] = 'Nombre producto no encontrado';
                    }
                }
                $datosCustomer = Usuario::detallesUser($db, $email);
                if($valor == "pdf"){
                    require_once "views/admin/facturas.php";
                }else{
                    require_once "views/admin/listarDetallesPedidos.php";
                }
                

            }

        }

    }


?>