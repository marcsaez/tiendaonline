<?php include "views/admin/navLateral.php"; ?>
<script src="js/buscadorAjax.js"></script>

<main class="dashboard listar" id="listar-productos">
    <div>
        <section>
            <h1>Pedidos</h1>
            <!-- <a href="index.php?Controller=Productos&action=paginaAnadirProductos">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
    
                Añadir
            </a> -->
        </section>
        <section>
        <form id="buscador" action="index.php?Controller=Productos&action=buscar" method="POST">
            <input type="text" id="termino" name="termino" placeholder="Indique el nombre del producto a buscar">
        </form>
        </section>
        <section>
            <table id="resultadosDivAdmin">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Fecha Creación</th>
                    <th>Fecha Envio</th>
                    <th>Estado</th>
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