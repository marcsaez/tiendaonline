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
                    echo"<td>".$stock."u</td>";
                    echo"<td>".$precio."€</td>";
                    if($destacado==0){
                        echo"<td>".'
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                            </svg>
                        '."</td>";
                    }else{
                        echo"<td>".'
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>
                        '."</td>";
                    }
                    
                    echo "<td>";
                    $activo = $isActive == 1 ? '<span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                  </svg>
                  Activo</span>' : "<span>No Activo</span>";

                    echo $activo;
                    echo "</td>";
                    echo"<td><a href='index.php?Controller=Productos&action=paginaEditar&id=$idproduct' class='editar'>".'
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>'."Editar</a></td>";

                    echo"<td><a href='index.php?Controller=Productos&action=paginaEliminar&id=$idproduct' class='eliminar'>".
                    '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>'."Eliminar</a></td>";
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