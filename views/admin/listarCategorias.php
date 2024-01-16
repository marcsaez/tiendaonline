<script src="js/productoConcreto.js"></script>
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

                    echo "<p>$idcategoria, $nombre, $categoriapadre ";
                    echo "<a href='#'><img onclick=\"mostrarOcultar('$idcategoria')\" src='img/editar.png' alt='Editar'></a>";
                    echo "<a href='index.php?Controller=Categorias&action=eliminar&IDCategoria=$idcategoria'>";
                    echo "<img src='img/borrar.png' alt='Eliminar'></a></p>";

                    // FORMULARIO EDITAR CATEGORIA
                    echo "<div id='$idcategoria' style='display:none;'>";
                    echo "    <form enctype='multipart/form-data' action='index.php?Controller=Categorias&action=editarCategoria' method='POST' class=''>";
                    echo "        <label for='id'>ID:</label>";
                    echo "        <input type='text' id='id' name='id' value='$idcategoria' readonly required>";
                    echo "";
                    echo "        <label for='nombre'>Nombre:</label>";
                    echo "        <input type='text' id='nombre' name='nombre' value='$nombre' required>";
                    echo "";
                    echo "        <label for='nombre'>Categoria padre:</label>";
                    echo "        <input type='number' id='categoriaPadre' name='categoriaPadre' value='$categoriapadre' min='1' max='100000' required>";
                    echo "";
                    echo "        <button type='submit'>Editar Categoria</button>";
                    echo "    </form>";
                    echo "</div>";
                } else {
                    echo "<p>$idcategoria, $nombre";
                    echo "<a href='#'><img onclick=\"mostrarOcultar('$idcategoria')\" src='img/editar.png' alt='Editar'></a>";
                    echo "<a href='index.php?Controller=Categorias&action=eliminar&IDCategoria=$idcategoria'>";
                    echo "<img src='img/borrar.png' alt='Eliminar'></a></p>";

                    // FORMULARIO EDITAR CATEGORIA
                    echo "<div id='$idcategoria' style='display:none;'>";
                    echo "    <form enctype='multipart/form-data' action='index.php?Controller=Categorias&action=editarCategoria' method='POST' class=''>";
                    echo "        <label for='id'>ID:</label>";
                    echo "        <input type='text' id='id' name='id' value='$idcategoria' readonly required>";
                    echo "";
                    echo "        <label for='nombre'>Nombre:</label>";
                    echo "        <input type='text' id='nombre' name='nombre' value='$nombre' required>";
                    echo "";
                    echo "        <input type='hidden' id='categoriaPadre' name='categoriaPadre' value='null'>";
                    echo "";
                    echo "        <button type='submit'>Editar Categoria</button>";
                    echo "    </form>";
                    echo "</div>";
                }
                
        }
    }else {
        echo "No hay productos para mostrar.";
    }
?>