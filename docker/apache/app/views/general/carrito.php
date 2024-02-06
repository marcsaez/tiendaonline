<div class="miCarrito">
    <h2>Mi carrito</h2>
    <!-- aqui se mostraran los productos generados mediante js para poder aumentar y disminuir la cantidad de forma dinamica-->
</div>
<div class="resuemn">
    <h2>Resumen</h2>
    <ul>
        <!-- Lista generada de productos con cantidad + precio en orden "CantidadXNombrePrecio" -->
    </ul>
    <p>Total : <span id="id">0</span></p>
    <p><?php echo $_SESSION['carrito']; ?></p>
</div>