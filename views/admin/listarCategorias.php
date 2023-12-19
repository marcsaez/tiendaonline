<a href="index.php?Controller=Admin&action=paginaAnadirCategoria"><img src="img/mas.png" alt="Anadir Categoria"></a>
<?php
    if (isset($allcategories) && is_array($allcategories)) {
        foreach ($allcategories as $categoria) {
                // Acceder a los campos del categoria
                $idproduct = $categoria['productid'];
                $nombre = $categoria['productname'];
                $descripcion = $categoria['productdescription'];
                $imagen = $categoria['productimg'];
                $stock = $categoria['productstock'];
                $destacado = $categoria['productnoted'];
                $precio = $categoria['productprice'];
                $categoria = $categoria['fkcategories'];

                //FALTARA AnADIR EL RESTO DE COSAS
                echo "<p>$nombre, $descripcion <a href='index.php?Controller=Productos&action=paginaEditar&id=$idproduct'><img src='img/editar.png' alt='Editar'></a></p>";
        }
    }else {
        echo "No hay productos para mostrar.";
    }
?>