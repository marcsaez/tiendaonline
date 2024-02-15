<!-- aqui se mostraran los productos generados mediante js para poder aumentar y disminuir la cantidad de forma dinamica-->
<!-- Lista generada de productos con cantidad + precio en orden "CantidadXNombrePrecio" -->
<script src="js/miCarrito.js"></script>
<script src="js/carritoNoLog.js"></script>
<main class="page-grid">
    <div></div>
    <section>
        <h1 class="page-title">Mi Carrito (<span id="numero-entradas-carrito"></span>)</h1>
        <div id="resumen-compra">
            <section id="sectionFantasma">
            </section>
            <section class="resumen-carrito">
                <h2>Resumen</h2>
                <table>  
                </table>
            </section>
        </div>
    </section>
    <div></div>
    <script>
        // Llamar a la función para obtener el carrito desde el sessionStorage
        var carrito = obtenerCarritoDesdeSessionStorage();
        // Llamar a la función para generar el resumen del carrito
        generarResumenCarrito(carrito);
        generarContenidoCarrito(carrito);
        document.getElementById('numero-entradas-carrito').textContent = Object.keys(carrito).length;
    </script>
</main>

