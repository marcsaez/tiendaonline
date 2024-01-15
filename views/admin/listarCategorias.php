<!-- <script src="js/productoConcreto.js"></script>
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
 <div id="editarCategoria" style="display:none;">
    <form enctype="multipart/form-data" action="index.php?Controller=Categorias&action=editarCategoria" method="POST" class = "">   
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="nombre">Categoria padre:</label>
        <input type="text" id="categoriaPadre" name="categoriaPadre">

        <button type="submit">Editar Categoria</button>
    </form>
</div> -->

<main class="dashboard" id="listar-categorias">
    <div>
        <section>
            <h1>Categorias</h1>
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
    
                Añadir
            </button>
        </section>
        <section>
            <input type="text" id="barraBusqueda" placeholder="Buscar por nombre">
            <button onclick="buscarRegistros()">Buscar</button>
        </section>
        <section>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría Padre</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
                <?php 
                    foreach ($allcategories as $categoria) {
                        $idCategoria = $categoria['categoryid'];
                        $nombreCategoria = $categoria['categoryname'];
                        $categoriaPadre = $categoria['fkfathercategory'];

                        $mostrarCategoriaPadre = ($categoriaPadre == null) ? "Sin Categoría" : $categoriaPadre;

                        echo '
                            <tr>
                                <td>'.$idCategoria.'</td>
                                <td>'.$nombreCategoria.'</td>
                                <td>'.$mostrarCategoriaPadre.'</td>
                                <td><a id="editar-categoria">Editar</a></td>
                                <td><a id="eliminar-categoria" href="index.php?Controller=Categorias&action=eliminar&IDCategoria='.$idCategoria.'">Eliminar</a></td>
                            </tr>
                        ';
                    }
                ?>
            </table>

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
                    echo "        <input type='text' id='categoriaPadre' name='categoriaPadre' value='$categoriapadre' required>";
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
        </section>
    </div>
</main>
