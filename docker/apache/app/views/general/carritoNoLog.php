<!-- aqui se mostraran los productos generados mediante js para poder aumentar y disminuir la cantidad de forma dinamica-->
<!-- Lista generada de productos con cantidad + precio en orden "CantidadXNombrePrecio" -->
<script src="js/miCarrito.js"></script>
<main class="page-grid">
    <div></div>
    <section>
        <h1 class="page-title">Mi Carrito (<?php echo isset($datosCarrito) ? count($datosCarrito) : '0'; ?>)</h1>
        <div id="resumen-compra">
            <section id="sectionFantasma">
                <script>
                    let divResumenCompra = document.getElementById('resumen-compra');
                    let sectionFaltante = document.createElement('section');
                    
                    divResumenCompra.appendChild(sectionFaltante);
                    // Función para recuperar el carrito del localStorage
                    function obtenerCarritoDesdeLocalStorage() {
                        var carritoJSON = sessionStorage.getItem('carrito');
                        return JSON.parse(carritoJSON);
                    }
                    // Función para generar el contenido HTML del carrito
                    function generarContenidoCarrito(carrito) {
                        var contenidoHTML = '';
                        // Recorrer cada producto en el carrito
                        for (var nombreProducto in carrito) {
                            if (carrito.hasOwnProperty(nombreProducto)) {
                                var producto = carrito[nombreProducto];
                                var precioTotal = parseFloat(producto.cantidad) * parseFloat(producto.precio);
                                contenidoHTML += `
                                    <article class="item-carrito">
                                        <div>
                                            <img src="${producto.imagen}" alt="${producto.nombre}">
                                        </div>
                                        <div>
                                            <h3>${producto.nombre}</h3>
                                        </div>
                                        <div>
                                            <p class="referencia">Ref: ${producto.id}</p>
                                        </div>
                                        <div>
                                            <p>Precio unitario: ${producto.precio}€</p>
                                        </div>
                                        <div class="grid-area-cantidad">
                                            <div class="containerCantidad">
                                                <button class="restar-cantidad">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                                    </svg>
                                                </button>
                                                <input type="text" class="cantidad" value="${producto.cantidad}" min="1">
                                                <button class="sumar-cantidad">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <div>
                                            <p>Precio Total: ${precioTotal.toFixed(2)}€</p>
                                        </div>
                                        <div>
                                            <button class="action-eliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                            Eliminar</button>
                                        </div>
                                    </article>
                                `;
                            }
                        }
                        // Insertar el contenido generado dentro del div con el id 'resumen-compra'
                        document.getElementById('sectionFantasma').innerHTML = contenidoHTML;
                    }
                    // Obtener el carrito del localStorage y generar el contenido del carrito
                    var carrito = obtenerCarritoDesdeLocalStorage();
                    sectionFaltante.innerHTML = generarContenidoCarrito(carrito);
                </script>
            </section>
            <section class="resumen-carrito">
                <h2>Resumen</h2>
                <table>
                    <?php 
                        foreach ($datosCarrito as $product) {
                            echo '
                                <tr>
                                    <td>'.$product['amount'].'</td>
                                    <td>x</td>
                                    <td>'.$product['productname'].'</td>
                                    <td class="precio-total-producto">'.$product['totalprice'].'€</td>
                                </tr>
                            ';
                        }
                    ?>
                    <tr>
                        <td colspan="3">Total</td>
                        <td id ="precio-total-compra"></td>
                    </tr>
                    <tr>
                        <td><button>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                            Finalizar compra
                        </button></td>
                    </tr>
                </table>
            </section>
        </div>
    </section>
    <div></div>
</main>

