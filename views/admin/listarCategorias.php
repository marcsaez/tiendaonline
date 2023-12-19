<a href="index.php?Controller=Admin&action=paginaAnadirCategoria"><img src="img/mas.png" alt="Anadir Categoria"></a>
<?php
    if (isset($allcategories) && is_array($allcategories)) {
        foreach ($allcategories as $categoria) {
                // Acceder a los campos del categoria
                $idcategoria = $categoria['categoryid'];
                $nombre = $categoria['categoryname'];
                $categoriapadre = $categoria['fkfathercategory'];
                if ($categoriapadre){
                    echo "<p>$idcategoria, $nombre, $categoriapadre <a href='index.php?Controller=Categorias&action=paginaEditar&id=$idcategoria'><img src='img/editar.png' alt='Editar'></a></p>";
                } else {
                    echo "<p>$idcategoria, $nombre <a href='index.php?Controller=Categorias&action=paginaEditar&id=$idcategoria'><img src='img/editar.png' alt='Editar'></a></p>";
                }
                
        }
    }else {
        echo "No hay productos para mostrar.";
    }
?>