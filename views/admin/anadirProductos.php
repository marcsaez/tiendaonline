<div>
    <form enctype="multipart/form-data" action="index.php?Controller=Productos&action=anadirProducto" method="POST" class = "">
    <h2>Añadir Producto</h2>
        <label for="nombre">ID del Producto:</label>
        <input type="text" id="id" name="idProducto" required>
        
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="descripcion">Descripción del Producto:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>

        <label for="imagen">URL de la Imagen:</label>
        <input type="file" id="imagen" name="imagen" accept=".jpg, .png, .jpeg" required>

        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required>

        <label for="destacado">Destacado:</label>
        <input type="checkbox" id="destacado" name="destacado">

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" required>

        <label for="categoria">Categoría:</label>
        <input type="text" id="categoria" name="categoria" >

        <button type="submit">Añadir Producto</button>

    </form>
</div>