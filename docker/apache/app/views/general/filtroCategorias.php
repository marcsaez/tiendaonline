<main class="page-grid">
    <div></div>
    <section>
        <section class="list-categories-products-header">
            <ul class="breadcrumbs">
                <li>
                    <a href="index.php">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                            <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                        </svg>
                    Inicio</a>
                </li>
            </ul>
            <h1><?php echo $nombre; ?></h1>
            <span></span>
        </section>
        <section class="product-filters">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                </svg>
                Filtros:
            </span>
            <span>
                <select name="orderby" id="orderby">
                    <option value="none" default>Order by</option>
                    <option value="asc">Ascendente</option>
                    <option value="des">Descendente</option>
                </select> 
                <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg> -->
            </span>
            <span>Mostrando <?php echo (isset($products) && is_array($products)) ? count($products) : '0'; ?>
             articulos</span>
        </section>
            <?php
            
            // SUBCATEGORIAS si existen
            if (isset($subcat) && is_array($subcat)){
                // echo '<select id="subcategorias" name="subcategorias">';
                // echo '<option value="" disabled selected>Subcategorias</option>';
                echo '<div class="subcategorias">';
                foreach ($subcat as $sub) {
                    $subid = $sub['categoryid'];
                    $subname = $sub['categoryname'];
                    $subfather = $sub['fkfathercategory'];
                    // echo '<option value="'.$subid.'">'.$subname.'</option>';
                    echo '
                    <div id="'.$subname.'">
                        <a id="'.$subname.'" href="index.php?Controller=Categorias&action=filtrar&categoria='.$subid.'&nombre='.$subname.'">'.$subname.'</a>
                    </div>
                    ';
            
                }
                echo '</div>';
            } ?>

        <section class="list-categories-products">
            <?php
            // PRODUCTOS
            if (isset($products) && is_array($products)){
                
                foreach ($products as $prod){
                    $prodid = $prod['productid'];
                    $prodname = $prod['productname'];
                    $proddescription = $prod['productdescription'];
                    $prodimg = $prod['productimg'];
                    $prodstock = $prod['productstock'];
                    $prodnoted = $prod['productnoted'];
                    $prodprice = $prod['productprice'];
                    $prodcat = $prod['fkcategories'];

                    if ($prodnoted == 1) {
                        $tendencia = '
                            <span class="tendencia"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.963 2.286a.75.75 0 0 0-1.071-.136 9.742 9.742 0 0 0-3.539 6.176 7.547 7.547 0 0 1-1.705-1.715.75.75 0 0 0-1.152-.082A9 9 0 1 0 15.68 4.534a7.46 7.46 0 0 1-2.717-2.248ZM15.75 14.25a3.75 3.75 0 1 1-7.313-1.172c.628.465 1.35.81 2.133 1a5.99 5.99 0 0 1 1.925-3.546 3.75 3.75 0 0 1 3.255 3.718Z" clip-rule="evenodd" />
                          </svg>
                          Tendencia</span>
                        ';
                    }
                    
                    echo '<article class="grid-productos">';
                    echo '
                        <div>
                            '.$tendencia.'
                            <a href="index.php?Controller=Productos&action=productoConcreto&productID='.$prodid.'" id="prod-img-link"><img src='.$prodimg.' alt="imagen"></a>
                        </div>
                        <div>
                            <a href="index.php?Controller=Productos&action=productoConcreto&productID='.$prodid.'">'.$prodname.'</a>
                        </div>
                        <div>
                            <span>'.$prodprice.'€</span>
                        </div>
                        <div>
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                Añadir
                            </button>
                        </div>
                    ';
                    echo '</article>';
                }
            } else {
                echo '
                    <div class="product-not-found">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#cacaca" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                        </svg>
                  
                        No se han encontrado productos.
                    </div>
                ';
            }
            
            ?>
        </section>        
    </section>
    <div></div>
</main>    
