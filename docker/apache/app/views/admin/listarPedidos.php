<?php include "views/admin/navLateral.php"; ?>
<script src="js/buscadorAjax.js"></script>

<main class="dashboard listar" id="listar-productos">
    <!-- PEDIDOS PENDIENTES -->
    <div class="admin-content">
        <section class="admin-headers">
            <h1>Pedidos</h1>
        </section>
        
        <section class="table-scroll">
            <table id="resultadosDivAdmin" class="admin-table">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Fecha Creación</th>
                    <th>Fecha Envio</th>
                    <th colspan="2">Estado</th>
                    
                </tr>            
    <?php
    if (isset($pendientes) && is_array($pendientes)) {
        foreach ($pendientes as $pendiente) {
                // Acceder a los campos del pendiente
                $idpedido = $pendiente['purchaseid'];
                $email = $pendiente['customeremail'];
                $totalcost = $pendiente['totalcost'];
                $creation = $pendiente['creationdate'];
                $send = $pendiente['senddate'];
                $estado = $pendiente['status'];
                
                echo "<tr>";
                    echo"<td>$idpedido</td>";
                    echo"<td class='table-email'>$email</td>";
                    echo"<td>".$totalcost."</td>";
                    echo"<td>$creation</td>";
                    echo"<td>".$send."</td>";
                    if($estado){
                        echo'<td><p class="pagado"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                        PAGADO</p></td>'; 
                    }else{
                        echo'<td><p class="no-pagado"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z" />
                        </svg>
                        NO PAGADO</p></td>'; 
                    }
                                 
                    echo'<td><a class="" href="index.php?Controller=Pedidos&action=detallePedido&idpedido='. $idpedido .'&valor=nopdf&email='. $email .'&totalcost='. $totalcost .'&creation='. $creation .'&send='. $send .'"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                  </svg>
                  Detalles</a></td>';
                echo "</tr>";
        }
    }else {
        echo "
            <tr>
                <td colspan='6'>No hay productos para mostrar.</td>
            </tr>
        ";
    }
    
?>
            </table>
        </section>
    </div>
</main>