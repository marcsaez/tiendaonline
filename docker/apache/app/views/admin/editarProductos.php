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
    <div class="admin-content">
        <section class="admin-headers">
            <h1>Productos</h1>
        </section>
        <fieldset>
            <legend>Editar Producto</legend>
            <form enctype="multipart/form-data" action="index.php?Controller=Productos&action=editarProductos" method="post" name="editar-producto" class="form-products">
                <!-- ID del producto (puedes ocultarlo si lo pasas por otro medio) -->
                <div>
                    <input type="hidden" id="product-id" name="product-id" value="<?php echo $idproduct; ?>">
                    <label for="nombre">Nuevo Nombre:</label>
                </div>
                <div>
                    <input type="text" id="id" name="id" value="<?php echo $idproduct; ?>" readonly>
                    <input type="text" id="nombre" name="nombre" class="input" value="<?php echo $nombre; ?>" required>
                </div>
                <div>
                    <label for="categoria">Categoría:</label>
                </div>
                <div>
                    <select name="categoria" id="categorias" class="input">
                    <option value="<?php echo $categoria;?>"><?php echo $categoryname;?></option>
                    <?php 
                             foreach ($desplegable as $categoria) {
                                
                               echo "<option value='" . $categoria['categoryid'] . "'>" .$categoria['categoryname'] . "</option>";
                             }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="imagen">Nueva Imagen:</label>
                </div>
                <div>
                    <input type="file" id="imagen" name="imagen">
                </div>
                <div>
                    <label for="destacado">Destacado:</label>
                </div>
                <div>
                    <input type="checkbox" id="destacado" class="input" name="destacado" <?php echo $destacado ? 'checked' : ''; ?>>
                </div>
                <div>
                    <label for="stock">Nuevo Stock:</label>
                </div>
                <div>
                    <input type="number" id="stock" class="input" name="stock" value="<?php echo $stock; ?>" required>
                </div>
                <div>
                    <label for="precio">Nuevo Precio:</label>
                </div>
                <div>
                    <input type="number" id="precio" class="input" name="precio" step="0.01" value="<?php echo $precio; ?>" required>
                </div>
                <div>
                    <label for="descripcion">Nueva Descripción:</label>
                </div>
                <div>
                    <textarea id="descripcion" class="input" name="descripcion" required><?php echo $descripcion; ?></textarea>
                </div>
                <div>
                    <button class="btn-cancelar"><a href="index.php?Controller=Productos&action=listarProductos">Cancelar</a></button>
                    <button type="submit" class="btn-submit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        Actualizar
                    </button>
                </div>
            </form>
        </fieldset>
    </div>
    
</main>
