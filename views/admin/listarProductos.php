<?php include "views/admin/navLateral.php"; ?>
<script src="js/buscadorAjax.js"></script>

<main class="dashboard listar" id="listar-productos">
    <div>
        <section>
            <h1>Productos</h1>
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
    </div>
    
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
</main>