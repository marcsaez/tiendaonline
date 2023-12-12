<div>
    <form enctype="multipart/form-data" action="index.php?Controller=Admin&action=anadirProducto" method="POST" class = "">
    <h2>Añadir Categoria</h2>
        
        
        <label for="nombre">Nombre de la categoria:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="nombre">ID de la Categoria padre:</label>
        <input type="text" id="id" name="idPadre">

        <button type="submit">Añadir Categoria</button>

    </form>
</div>