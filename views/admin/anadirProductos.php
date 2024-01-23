<?php include "views/admin/navLateral.php"; ?>
<main class="dashboard listar">
    <div>
        <section>
            <h1>Productos</h1>
        </section>
        <fieldset>
            <legend>Añadir Producto</legend>
            <form enctype="multipart/form-data" action="index.php?Controller=Productos&action=anadirProducto" method="POST" name="anadir-producto">
                <div>
                    <label for="nombre">Nombre del Producto:</label>
                </div>
                <div>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div>
                    <label for="categoria">Categoría:</label>
                </div>
                <div>
                    <select name="categoria" id="categorias">
                    <option value="" disabled selected>Selecciona</option>
                        <?php 
                             foreach ($desplegable as $categoria) {
                                echo "<option>" . $categoria['categoryname'] . "</option>";
                             }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="imagen">Imagen:</label>
                </div>
                <div>
                    <input type="file" id="imagen" name="imagen"  required>
                </div>
                <div>
                    <label for="destacado">Destacado:</label>
                </div>
                <div>
                    <input type="checkbox" id="destacado" name="destacado">
                </div>
                <div>
                    <label for="stock">Stock:</label>
                </div>
                <div>
                    <input type="number" id="stock" name="stock" required>
                </div>
                <div>
                    <label for="precio">Precio:</label>
                </div>
                <div>
                    <input type="number" id="precio" name="precio" step="0.01" required>
                </div>
                <div>
                    <label for="descripcion">Descripción del Producto:</label>
                </div>
                <div>
                    <textarea id="descripcion" name="descripcion" maxlength="255" required></textarea>
                </div>
                <div>
                    <button type="submit">Añadir Producto</button>
                </div>
            </form>
        </fieldset>
    </div>
</main>