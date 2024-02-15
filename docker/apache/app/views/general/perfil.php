<main class="page-grid">
    <div></div>
    
    <section>

        <h1 class="page-title">Mis Pedidos</h1>
        <?php 
            if(isset($resultado)){

            
        ?>
        <table id="orders-table">
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Fecha Pedido</th>
                    <th>Enviado</th>
                    <th>Estado</th>
                    <th>Precio Compra</th>
                    <th>Factura</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($resultado as &$valor){
                        echo"<tr>";
                        echo '<td>'.$valor['purchaseid'].'</td>';
                        echo '<td>'.$valor['creationdate'].'</td>';
                        if(isset($valor['senddate'])){
                            echo '<td>Sí</td>';
                        }else{
                            echo '<td>No</td>';
                        }
                        echo '<td>'.$valor['status'].'</td>';
                        echo '<td>'.$valor['totalcost'].'</td>';
                        
                        echo '<td><a href="indexAjax.php?Controller=Pedidos&action=detallePedido&idpedido='.$valor['purchaseid'].'&email='.$email.'&valor=pdf&totalcost=0">Descargar</a></td>';
                        
                        echo"</tr>";
                    }
            
                ?>
            </tbody>
        </table>
        <?php
            }else{
                echo "<h3>No dispones de ningun pedido efectuado todavia</h3>";
            }
        ?>
    </section>
    <div></div>
</main>