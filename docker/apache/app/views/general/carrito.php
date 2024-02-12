<!-- aqui se mostraran los productos generados mediante js para poder aumentar y disminuir la cantidad de forma dinamica-->
<!-- Lista generada de productos con cantidad + precio en orden "CantidadXNombrePrecio" -->
<main class="page-grid">
    <div></div>
    <section>
        <h1 class="page-title">Mi Carrito (<?php //echo count($_SESSION['carrito']); ?>)</h1>
        
        <div id="resumen-compra">
            <section>
                <?php 
                    foreach ($_SESSION['carrito'] as $product) {
                        echo '<article class="item-carrito">
                        <div>
                        <img src='.$product['productimg'].' alt='.$product['productname'].'>
                        </div>
                        <div>
                                    <h3>'.$product['productname'].'</h3>
                                </div>
                                <div class="grid-area-cantidad">
                                    <div class="containerCantidad">
                                        <button id="restar-cantidad">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                            </svg>
                                        </button>
                                        <input type="text" id="cantidad" value="1" min="1">
                                        <button id="sumar-cantidad">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </button>
                                    </div>
                                    <span class="price-detail">'.$product['cantidad'].'x'.$product['productprice'].'€</span>
                                </div>
                                <div>
                                    <button class="action-eliminar">   
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                        Eliminar
                                    </button>
                                </div>
                        </article>';
                    }
                    ?>
            </section>
            <section>
                <h2>Resumen</h2>
                <?php 
                    foreach ($_SESSION['carrito'] as $product) {
                        echo $product['productname'].$product['cantidad']." x ".$product['productprice'];
                    }
                ?>
            </section>
        </div>
    </section>
    <div></div>
</main>
