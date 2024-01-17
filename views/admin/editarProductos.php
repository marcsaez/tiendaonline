<?php
    include "views/admin/navLateral.php";
    foreach ($productoDetalles as $productos) {
        // Acceder a los campos del producto
        $idproduct = $productos['productid'];
        $nombre = $productos['productname'];
        $descripcion = $productos['productdescription'];
        $imagen = $productos['productimg'];
        $stock = $productos['productstock'];
        $destacado = $productos['productnoted'];
        $precio = $productos['productprice'];
        $categoria = $productos['fkcategories'];
    }
?>

<main class="dashboard listar">
    <div>
        <section>
            <h1>Productos</h1>
        </section>
        <fieldset>
            <legend>Editar Producto</legend>
            <form enctype="multipart/form-data" action="index.php?Controller=Productos&action=editarProductos" method="post" name="editar-producto">
                <!-- ID del producto (puedes ocultarlo si lo pasas por otro medio) -->
                <input type="text" id="id" name="id" value="<?php echo $idproduct; ?>" readonly>
            
                <label for="nombre">Nuevo Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
            
                <label for="descripcion">Nueva Descripción:</label>
                <textarea id="descripcion" name="descripcion" required><?php echo $descripcion; ?></textarea>
            
                <label for="imagen">Nueva Imagen:</label>
                <input type="file" id="imagen" name="imagen">
            
                <label for="stock">Nuevo Stock:</label>
                <input type="number" id="stock" name="stock" value="<?php echo $stock; ?>" required>
            
                <label for="destacado">Destacado:</label>
                <input type="checkbox" id="destacado" name="destacado" <?php echo $destacado ? 'checked' : ''; ?>>
            
                <label for="precio">Nuevo Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" value="<?php echo $precio; ?>" required>
            
                <label for="categoria">Categoría:</label>
                    <select name="categoria" id="categorias">
                    <option value="" disabled selected>Selecciona</option>
                        <?php 
                             foreach ($desplegable as $categoria) {
                                echo "<option>" . $categoria['categoryname'] . "</option>";
                             }
                        ?>
                    </select>
            
                <button type="submit">Actualizar Producto</button>
            </form>
        </fieldset>
    </div>
    
</main>
