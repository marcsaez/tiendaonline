<?php include "views/admin/navLateral.php"; ?>
<script src="js/buscadorAjax.js"></script>

<main class="dashboard listar" id="listar-productos">
    <div class="admin-content">
        <section class="admin-headers">
            <h1>Productos</h1>
            <a href="index.php?Controller=Productos&action=paginaAnadirProductos">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
    
                Añadir
            </a>
        </section>
        <section class="admin-busqueda">
            <form id="buscador" action="index.php?Controller=Productos&action=buscar" method="POST">
                <input type="text" id="termino" name="termino" placeholder="Indique el nombre del producto a buscar">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="gray" class="search-icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>

            </form>
        </section>
        <section class="table-scroll">
            <table id="resultadosDivAdmin" class="admin-table">
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th class="destacado">Destacado</th>
                    <th>Estado</th>
                    <th>Editar</th>
                    <th>Cambiar Estado</th>
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

                    
                    
                    if ($destacado == 0) {
                        $destacado_html = '<td class="destacado" data-destacado="1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                          </svg></td>';
                    } else {
                        $destacado_html = '<td class="destacado" data-destacado="0"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                        </svg></td>';
                    }
                    
                    $activo_html = '<td>' . ($isActive == 1 ? '<span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /> </svg> Activo</span>' : '<span style="background-color: #B82626"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Inactivo</span>') . '</td>'; 
                    
                    $editar_html = '<td><a href="index.php?Controller=Productos&action=paginaEditar&id=' . $idproduct . '" class="editar"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                      </svg>Editar</a></td>';
                    
                    $eliminar_html = '<td><a href="index.php?Controller=Productos&action=paginaEliminar&id=' . $idproduct . '&activo='. $isActive .'" class="eliminar"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 0a1 1 0 0 1 1 1v5.3a1 1 0 0 1-2 0V2a1 1 0 0 1 1-1zM5.707 3.707a1 1 0 1 1 1.414-1.414l3.3 3.3a1 1 0 0 1 0 1.414l-3.3 3.3a1 1 0 1 1-1.414-1.414L8.586 7 5.707 4.121zM11 10a1 1 0 0 1 1 1h5.3a1 1 0 0 1 0-2H12a1 1 0 0 1-1 1zM15.293 13.707a1 1 0 0 1-1.414-1.414l3.3-3.3a1 1 0 0 1 1.414 1.414l-3.3 3.3a1 1 0 0 1-1.414 0zM10 15a1 1 0 0 1-1-1V8.7a1 1 0 0 1 2 0V14a1 1 0 0 1-1 1z" clip-rule="evenodd" />
                  </svg>Modificar</a></td>';
                    
                    echo $destacado_html . $activo_html . $editar_html . $eliminar_html;
                    
                echo "</tr>";
        }
    }else {
        echo "
            <tr>
                <td colspan='6'>No hay productos para mostrar.</td>
            </tr>
        ";
    }
?>
            </table>
        </section>
    </div>
</main>