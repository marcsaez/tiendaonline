<h2>Editar Producto</h2>

<form action="index.php?Controller=Admin&action=editarProductos" method="post">
    <!-- ID del producto (puedes ocultarlo si lo pasas por otro medio) -->
    <label for="id">ID del Producto:</label>
    <input type="text" id="id" name="id" required>

    <label for="nombre">Nuevo Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="descripcion">Nueva Descripción:</label>
    <textarea id="descripcion" name="descripcion" required></textarea>

    <label for="imagen">Nueva Imagen (URL):</label>
    <input type="text" id="imagen" name="imagen" required>

    <label for="stock">Nuevo Stock:</label>
    <input type="number" id="stock" name="stock" required>

    <label for="destacado">Destacado:</label>
    <input type="checkbox" id="destacado" name="destacado">

    <label for="precio">Nuevo Precio:</label>
    <input type="number" id="precio" name="precio" step="0.01" required>

    <label for="categoria">Nueva Categoría:</label>
    <input type="text" id="categoria" name="categoria" required>

    <button type="submit">Actualizar Producto</button>
</form>