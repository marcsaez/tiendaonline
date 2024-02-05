<?php include "views/admin/navLateral.php"; ?>
 <script src="js/admin.js"></script>
 <script src="./js/productoConcreto.js"></script>
 <script src="./js/buscadorCategoria.js"></script>
<!-- <h2 onclick="mostrarOcultar('anadirCategoria')"><img src="img/mas.png" alt="Anadir Categoria"></h2> -->
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
</div>

<main class="dashboard listar" id="listar-categorias">
    <div>
        <section>
            <h1>Categorias</h1>
            <button id="btn-mostrarCategoria">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                
                Añadir
            </button>
            <div id="anadirCategoria" style="display:none;">
                <fieldset>
                    <legend>Añadir Categoria</legend>
                    <form enctype="multipart/form-data" action="index.php?Controller=Categorias&action=anadirCategoria" method="POST" >   
                        <label for="nombre">Nombre de la categoria:</label>
                        <input type="text" id="nombre" name="nombre" class="input" required>
                
                        <?php
                        echo '<label for="nombre">ID de la Categoria padre:</label>';
                        echo '<select id="categoriaPadre" name="categoriaPadre" class="input">';
                        echo '<option value="" selected>Sin categoria padre</option>';
                        
                        foreach ($padres as $category) {
                            echo '<option value="' . $category['categoryid'] . '">' . $category['categoryname'] . '</option>';
                        }
                        
                        echo '</select>';
                        ?>
                
                        <button type="submit" class="btn-submit">Añadir Categoria</button>
                    </form>
                </fieldset>
            </div>
        </section>
        <section>
            <fieldset id="editar-categoria" style="display: none;">
                <legend>Editar Categoria</legend>
                <form action="index.php?Controller=Categorias&action=editarCategoria" method="POST" name="editarCategoria" >
                    <label for="id">ID:</label>
                    <input type="text" name="id-editar" id="id-editar" class="input" readonly>
                    <label for="nombre-editar">Nombre:</label>
                    <input type="text" name="nombre-editar" id="nombre-editar" class="input" required>
                    <label for="categoriaPadre">Categoria Padre:</label>
                    <input type="text" name="categoriaPadre-editar" id="categoriaPadre-editar" class="input">
                    <button id="cancelar-edit-categoria" class="btn-cancelar">Cancelar</button>
                    <input type="submit" class="btn-submit" value="Guardar">
                </form>
            </fieldset>
            <form id="buscador" action="index.php?Controller=Categorias&action=buscar" method="POST">
                <input type="text" id="termino" name="termino" placeholder="Indique el nombre de la categoria a buscar">
            </form>
        </section>
        <section>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Categoría Padre</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
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
                                <td>'.$categoriaPadre.'</td>
                                <td>
                                <a class="editar btn-categoria-editar"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>Editar</a></td>
                                <td><a class="eliminar" href="index.php?Controller=Categorias&action=eliminar&IDCategoria='.$idCategoria.'"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>Eliminar</a></td>
                            </tr>
                            
                        ';
                    }
                ?>
                </tbody>
            </table>
<?php
//    if (isset($allcategories) && is_array($allcategories)) {
//         foreach ($allcategories as $categoria) {
//                 // Acceder a los campos del categoria
//                 $idcategoria = $categoria['categoryid'];
//                 $nombre = $categoria['categoryname'];
//                 $categoriapadre = $categoria['fkfathercategory'];
//                 if ($categoriapadre){

//                     echo "<p>$idcategoria, $nombre, $categoriapadre ";
//                     echo "<a href='#'><img onclick=\"mostrarOcultar('$idcategoria')\" src='img/editar.png' alt='Editar'></a>";
//                     echo "<a href='index.php?Controller=Categorias&action=eliminar&IDCategoria=$idcategoria'>";
//                     echo "<img src='img/borrar.png' alt='Eliminar'></a></p>";

//                     // FORMULARIO EDITAR CATEGORIA
//                     echo "<div id='$idcategoria' style='display:none;'>";
//                     echo "    <form enctype='multipart/form-data' action='index.php?Controller=Categorias&action=editarCategoria' method='POST' class=''>";
//                     echo "        <label for='id'>ID:</label>";
//                     echo "        <input type='text' id='id' name='id' value='$idcategoria' readonly required>";
//                     echo "";
//                     echo "        <label for='nombre'>Nombre:</label>";
//                     echo "        <input type='text' id='nombre' name='nombre' value='$nombre' required>";
//                     echo "";
//                     echo "        <label for='nombre'>Categoria padre:</label>";
//                     echo "        <input type='number' id='categoriaPadre' name='categoriaPadre' value='$categoriapadre' min='1' max='100000' required>";
//                     echo "";
//                     echo "        <button type='submit'>Editar Categoria</button>";
//                     echo "    </form>";
//                     echo "</div>";
//                 } else {
//                     echo "<p>$idcategoria, $nombre";
//                     echo "<a href='#'><img onclick=\"mostrarOcultar('$idcategoria')\" src='img/editar.png' alt='Editar'></a>";
//                     echo "<a href='index.php?Controller=Categorias&action=eliminar&IDCategoria=$idcategoria'>";
//                     echo "<img src='img/borrar.png' alt='Eliminar'></a></p>";

//                     // FORMULARIO EDITAR CATEGORIA
//                     echo "<div id='$idcategoria' style='display:none;'>";
//                     echo "    <form enctype='multipart/form-data' action='index.php?Controller=Categorias&action=editarCategoria' method='POST' class=''>";
//                     echo "        <label for='id'>ID:</label>";
//                     echo "        <input type='text' id='id' name='id' value='$idcategoria' readonly required>";
//                     echo "";
//                     echo "        <label for='nombre'>Nombre:</label>";
//                     echo "        <input type='text' id='nombre' name='nombre' value='$nombre' required>";
//                     echo "";
//                     echo "        <input type='hidden' id='categoriaPadre' name='categoriaPadre' value='null'>";
//                     echo "";
//                     echo "        <button type='submit'>Editar Categoria</button>";
//                     echo "    </form>";
//                     echo "</div>";
//                 }
                
//         }
//     }else {
//         echo "No hay productos para mostrar.";
//     }
?>
        </section>
    </div>
</main>

<script src="js/admin.js"></script>
