<?php include "views/admin/navLateral.php"; ?>
<script src="js/buscadorAjax.js"></script>

<main class="dashboard listar" id="listar-productos">
    <!-- PEDIDOS PENDIENTES -->
    <div class="admin-content">
        <section class="admin-headers">
            <h1>Pedidos</h1>
        </section>
        <section class="admin-busqueda">
            <form id="buscador" action="index.php?Controller=Productos&action=buscar" method="POST">
                <input type="text" id="termino" name="termino" placeholder="Indique el nombre del pedido a buscar">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="gray" class="search-icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </form>
        </section>
        <section>
            <table id="resultadosDivAdmin" class="admin-table">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Fecha Creación</th>
                    <th>Fecha Envio</th>
                    <th>Estado</th>
                    <th></th>
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
                    echo"<td>$email</td>";
                    echo"<td>".$totalcost."€</td>";
                    echo"<td>$creation</td>";
                    echo"<td>".$send."</td>";
                    echo'<td><a class="">PENDIENTE<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg></a></td>';               
                    echo'<td><a class="" href="index.php?Controller=Pedidos&action=detallePedido&idpedido='. $idpedido .'&valor=nopdf&email='. $email .'&totalcost='. $totalcost .'&creation='. $creation .'&send='. $send .'">Detalles</a></td>';
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