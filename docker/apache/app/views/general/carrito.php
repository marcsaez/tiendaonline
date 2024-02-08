<!-- aqui se mostraran los productos generados mediante js para poder aumentar y disminuir la cantidad de forma dinamica-->
<!-- Lista generada de productos con cantidad + precio en orden "CantidadXNombrePrecio" -->
<!-- <div class="resuemn">
    <h2>Resumen</h2>
    <ul>
    </ul>
    <p>Total : <span id="id">0</span></p>
    <p>></p>
</div> -->
<main class="page-grid">
    <div></div>
    <section>
        <h1 class="page-title">Mi Carrito (X)</h1>
        <p>
            <?php
                if (isset($_SESSION['carrito'])){
                    print_r($_SESSION['carrito']);
                } else {
                    echo "No hay productos en el carrito.";
                }
            ?>
        </p>
    </section>
    <div></div>
</main>
