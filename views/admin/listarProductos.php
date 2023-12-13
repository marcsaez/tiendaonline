<a href="index.php?Controller=Productos&action=paginaAnadirProductos"><img src="img/mas.png" alt="Añadir Producto"></a>
<?php
// Suponiendo que estás creando una instancia de ProductosController
  
    if (isset($allproducts) && is_array($allproducts)) {
        foreach ($allproducts as $producto) {
                // Acceder a los campos del producto
                $idproduct = $producto['productid'];
                $nombre = $producto['productname'];
                $descripcion = $producto['productdescription'];
                $imagen = $producto['productimg'];
                $stock = $producto['productstock'];
                $destacado = $producto['productnoted'];
                $precio = $producto['productprice'];
                $categoria = $producto['fkcategories'];

                //FALTARA AnADIR EL RESTO DE COSAS
                echo "<p>$nombre, $descripcion <a href='index.php?Controller=Productos&action=paginaEditar&id=$idproduct'><img src='img/editar.png' alt='Editar'></a></p>";
        }
    }else {
        echo "No hay productos para mostrar.";
    }
?>