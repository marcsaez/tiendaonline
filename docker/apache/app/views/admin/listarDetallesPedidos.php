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
                        <form enctype="multipart/form-data" action="index.php?Controller=Carrito&action=enviarPedido" method="post" id="form-enviar">
                            <label for="opcional">Enviar pedido? </label>
                            Si <input type="checkbox" id="opcional" name="opcional">
            
                            <input type="hidden" id="purchaseid" name="id" value="<?php echo $purchaseid; ?>">
                            <button type="submit" id="btn-enviar"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                            Enviar</button>
                        </form>
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
                                $purchaseid = $_GET['idpedido'];
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
