<script src="js/buscadorAjax.js"></script>

<a href="index.php?Controller=Productos&action=paginaAnadirProductos"><img src="img/mas.png" alt="Añadir Producto"></a>

<div id="buscadorAJAX">
    <form id="buscador" action="index.php?Controller=Productos&action=buscar" method="POST">
        <input type="text" id="termino" name="termino" placeholder="Indique el nombre del producto a buscar">
    </form>
º
    </div>
<div id="resultadosDiv"></div>
<?php
// Suponiendo que estás creando una instancia de ProductosController
    echo "<div>";
        echo "<div>ID</div>";
        echo "<div>Imagen</div>";
        echo "<div>Nombre</div>";
        echo "<div>Categoria</div>";
        echo "<div>Stock</div>";
        echo "<div>Precio</div>";
        echo "<div>Destacado</div>";
    echo "</div>";
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
                echo "<div>";
                    echo"<div>$idproduct</div>";
                    echo"<div><img src='$imagen' alt='Imagen de $nombre'></div>";
                    echo"<div>$nombre</div>";
                    echo"<div>$categoria</div>";
                    echo"<div>$nombreCategoria</div>";
                    echo"<div>$stock</div>";
                    echo"<div>$precio</div>";
                    if($destacado==0){
                        echo"<div><img src='img/seleccion.png' alt='Destacado'></div>";
                    }else{
                        echo"<div><img src='img/cuadrado.png' alt='No destacado'></div>";
                    }
                    echo"<div><a href='index.php?Controller=Productos&action=paginaEditar&id=$idproduct'><img src='img/editar.png' alt='Editar'></a></div>";
                    echo"<div><a href='index.php?Controller=Productos&action=paginaEliminar&id=$idproduct'><img src='img/borrar.png' alt='Eliminar'></a></div>";
                echo "</div>";
        }
    }else {
        echo "No hay productos para mostrar.";
    }
?>