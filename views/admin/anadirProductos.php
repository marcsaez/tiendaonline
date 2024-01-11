<div>
    <form enctype="multipart/form-data" action="index.php?Controller=Productos&action=anadirProducto" method="POST" class = "">
    <h2>Añadir Producto</h2>
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="descripcion">Descripción del Producto:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>

        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen"  required>

        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required>

        <label for="destacado">Destacado:</label>
        <input type="checkbox" id="destacado" name="destacado">

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" required>

        <label for="categoria">Categoría:</label>
        <select name="categoria" id="categorias">
        <option value="" disabled selected>Selecciona</option>
            <?php 
                 foreach ($desplegable as $categoria) {
                    echo "<option>" . $categoria['categoryname'] . "</option>";
                 }
            ?>
        </select>

        <button type="submit">Añadir Producto</button>

    </form>
</div>