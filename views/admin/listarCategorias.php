<script src="../../js/productoConcreto.js"></script>
<h2 onclick="mostrarOcultar('anadirCategoria')"><img src="img/mas.png" alt="Anadir Categoria"></h2>
<div id="anadirCategoria" style="display:none;">
    <h3>Añadir categoria: </h3>
    <form enctype="multipart/form-data" action="index.php?Controller=Categorias&action=anadirCategoria" method="POST" class = "">   
        <label for="nombre">Nombre de la categoria:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="nombre">ID de la Categoria padre:</label>
        <input type="text" id="categoriaPadre" name="categoriaPadre">

        <button type="submit">Añadir Categoria</button>
    </form>
</div>

<!-- Listar categorias -->
<?php
    if (isset($allcategories) && is_array($allcategories)) {
        foreach ($allcategories as $categoria) {
                // Acceder a los campos del categoria
                $idcategoria = $categoria['categoryid'];
                $nombre = $categoria['categoryname'];
                $categoriapadre = $categoria['fkfathercategory'];
                if ($categoriapadre){
                    echo "<p>$idcategoria, $nombre, $categoriapadre <a href='index.php?Controller=Categorias&action=paginaEditar&id=$idcategoria'><img src='img/editar.png' alt='Editar'></a><a href='index.php?Controller=Categorias&action=eliminar&IDCategoria=$idcategoria'><img src='img/borrar.png' alt='Eliminar'></a></p>";
                } else {
                    echo "<p>$idcategoria, $nombre <a href='index.php?Controller=Categorias&action=paginaEditar&id=$idcategoria'><img src='img/editar.png' alt='Editar'></a><a href='index.php?Controller=Categorias&action=eliminar&IDCategoria=$idcategoria'><img src='img/borrar.png' alt='Eliminar'></a></p>";
                }
                
        }
    }else {
        echo "No hay productos para mostrar.";
    }
?>