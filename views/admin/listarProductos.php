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
        <section>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Destacado</th>
                    <th>Activo</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
    <?php
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
                $isActive = $producto['active'];
                echo "<tr>";
                    echo"<td>$idproduct</td>";
                    echo"<td><img src='$imagen' alt='Imagen de $nombre'></td>";
                    echo"<td>$nombre</td>";
                    echo"<td>$categoria</td>";
                    echo"<td>$stock</td>";
                    echo"<td>$precio</td>";
                    if($destacado==0){
                        echo"<td><img src='img/seleccion.png' alt='Destacado'></td>";
                    }else{
                        echo"<td><img src='img/cuadrado.png' alt='No destacado'></td>";
                    }
                    echo "<td>$isActive</td>";
                    echo"<td><a href='index.php?Controller=Productos&action=paginaEditar&id=$idproduct'><img src='img/editar.png' alt='Editar'></a></td>";
                    echo"<td><a href='index.php?Controller=Productos&action=paginaEliminar&id=$idproduct'><img src='img/borrar.png' alt='Eliminar'></a></td>";
                echo "</tr>";
        }
    }else {
        echo "No hay productos para mostrar.";
    }
?>
                
            </table>
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
    
</main>