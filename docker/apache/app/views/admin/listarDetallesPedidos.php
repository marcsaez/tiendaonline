<?php include "views/admin/navLateral.php"; ?>
<?php
    if (isset($result) && is_array($result)){
        $nombre = $datosCustomer["customername"];
        $email = $datosCustomer["email"];
        $telefono = $datosCustomer["customerphone"];
        $direccion = $datosCustomer["customeraddress"];
        
       // print_r($productsInfo);
        ?>
        <main class="dashboard">
            <div class="admin-content">
                <section class="admin-headers">
                    <h1>Detalle Pedido</h1>
                </section>
                <section>
                    <div id="customer-email" data-email="<?php echo $email; ?>"></div>
                    <div id="factura">
                        <fieldset>
                            <legend>Datos Cliente</legend>
                            <section id="datos-usuario">
                                <div>
                                    Nombre:
                                </div>
                                <div>
                                    Email:
                                </div>
                                <div>
                                    Telefono:
                                </div>
                                <div>
                                    Direccion:
                                </div>
                                <div>
                                    <?php echo $nombre ?>
                                </div>
                                <div>
                                    <?php echo $email ?>
                                </div>
                                <div>
                                    <?php echo $telefono ?>
                                </div>
                                <div>
                                    <?php echo $direccion ?>
                                </div>
                            </section>
                        </fieldset>
                      
                        <table class="admin-table">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Precio Total</th>
                            </tr>
                            <?php
                            $totalPriceSum = 0;
                                foreach ($result as &$value) {
                                    $totalPriceSum += $value['totalprice']; // Sumamos el valor de totalprice en cada iteración
                                    ?>
                                    <tr>
                                        <td><?php echo $value['fkproduct'] ?></td>
                                        <td><?php echo $value['productname'] ?></td>
                                        <td><?php echo $value['amount'] ?> unidades</td>
                                        <td><?php echo $value['totalprice'] ?>€</td>
                                    </tr>
                                    <?php
                                }
                            ?>
                            <tr>
                                <td colspan="3">Total</td>
                                <td><?php echo $totalPriceSum ?>€</td>
                            </tr>
                            <tr>
                                <!-- COLOR LILA SIEMPRE Y EN EL CENTRO PORFAVOR !--> 
                                <th colspan="4"><a href="index.php?Controller=Pedidos&action=detallePedido&idpedido= <?php echo "$id" ?>&email=<?php echo "$email" ?>&valor=pdf&totalcost=<?php echo "$totalpriceSum" ?>">Descargar PDF</a></th>
                            </tr>
                        </table>
                    </div>      
                </section>
            </div>
        </main>
        <?php
    } else{
        ?>
        <main class="dashboard">
            <div class="admin-content">
                <section class="admin-headers">
                    <h1>Detalle Pedido</h1>
                </section>
                <section>
                    <div id="customer-email" data-email="<?php echo $email; ?>"></div>
                    <div id="factura">
                        <fieldset>
                            <legend>Datos Cliente</legend>
                            <section id="datos-usuario">
                                <div>
                                    Nombre:
                                </div>
                                <div>
                                    Email:
                                </div>
                                <div>
                                    Telefono:
                                </div>
                                <div>
                                    Direccion:
                                </div>
                                <div>
                                    <?php echo "Sin Datos por el momento" ?>
                                </div>
                                <div>
                                <?php echo "Sin Datos por el momento" ?>
                                </div>
                                <div>
                                <?php echo "Sin Datos por el momento" ?>
                                </div>
                                <div>
                                <?php echo "Sin Datos por el momento" ?>
                                </div>
                            </section>
                        </fieldset>
                      
                        <table class="admin-table">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Precio Total</th>
                            </tr>
                            <?php
                            $totalPriceSum = 0;
                            ?>
                            <tr>
                                <td><?php echo "Sin Datos por el momento" ?></td>
                                <td><?php echo "Sin Datos por el momento" ?></td>
                                <td><?php echo "Sin Datos por el momento" ?></td>
                                <td><?php echo "0€" ?></td>
                            </tr>
                            <tr>
                                <td colspan="3">Total</td>
                                <td><?php echo $totalPriceSum ?>€</td>
                            </tr>
                            <tr>
                                <!-- COLOR LILA SIEMPRE Y EN EL CENTRO PORFAVOR !--
                            </tr>
                        </table>
                    </div>      
                </section>
            </div>
        </main>
        <?php }
    
?>
