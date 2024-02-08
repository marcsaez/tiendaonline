<script type="module" src="./js/productoConcreto.js"></script>
<main class="page-grid">
    <section class="void"></section>
    <section class="pagina-producto">
        <section>
            <ul class="breadcrumbs">
                <li>
                    <a href="index.php">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                            <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                        </svg>    
                        Inicio
                    </a></li>
            </ul>
        </section>
        <section class="imagen-container">
            <img src="<?php echo $productoConcreto[0]['productimg'];?>" alt="Foto del producto">
        </section>
        <section>
            <input type="hidden" name="stockMaximo" id="stockMaximo" value="<?php echo $productoConcreto[0]['productstock']; ?>">
            <input type="hidden" name="nombreProd" id="nombreProd" value="<?php  echo $productoConcreto[0]['productname'];?>">
            <input type="hidden" name="idDelProducto" id="idDelProducto" value="<?php  echo $productoConcreto[0]['productid'];?>">

            <div>
                <h1><?php echo $productoConcreto[0]['productname'];?></h1>
                <div>
                    <span><?php echo ($productoConcreto[0]['productprice']+3); ?>€</span>
                    <h1 id="precioProducto"><?php echo $productoConcreto[0]['productprice']; ?>€</h1>
                </div>
            </div>
            <section class="reference-product">
                <div>
                    <span id="productId"> Ref: <?php echo $productoConcreto[0]['productid']; ?></span>
                    <p>Disponibilidad:
                    <?php
                        if($productoConcreto[0]['productstock']>0){
                           
                            echo"<span id='si-stock'>En stock</span>";//El css sera verde
                        }
                        else{
                            echo"<span id='no-stock'>Sin stock</span>";//El css en rojo
                        }
                    ?> </p>
                </div>
                
                <button class="btn-comprar" <?php if(isset($_SESSION['userType']) && $_SESSION['userType']=="usuario"){ echo 'id="comprarYa"';}else{echo'id="comprarYaNoLogeado"';} ?> >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                        
                    <a href="index.php?Controller=Carrito&action=abrirCarrito">Comprar ya</a>
                </button>
            </section>
            <article>
                <h2>Cantidad</h2>
                <div id="container-cantidad">
                    <div class="containerCantidad">
                        <button id="restar-cantidad">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                        </button>
                        <input type="text" id="cantidad" value="1" min="1">
                        <button id="sumar-cantidad">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                    </div>
                    <button id="btnAnadir">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>

                        Añadir
                    </button>
                </div>
            </article>
            <article>
                <div class="producto-info">
                    <h2>Sinopsis</h2>
                    <!-- <span onclick="mostrarOcultar('descripcionProd')">+</span> -->
                    <span class="plusminus"></span>
                </div>
                <div class="descripcionProd">
                    <p><?php echo $productoConcreto[0]['productdescription']; ?></p>
                </div>
            </article>
            <article>
                <div class="producto-info">
                    <h2>Mas información</h2>
                    <span class="plusminus"></span>
                </div>
                <div class="descripcionProd">
                    <h3>Categoria: <span><?php echo $nombreCategoria?></span> </h3>
                    
                    <?php 
                    if(isset($masProds)){
                        echo"<h3>Genero: </h3>";
                        echo $nombreCategoria;
                    }
                     
                    ?>
                </div>
            </article>
        </section>
        <section class="mas-productos-container">
            <h2>Mas <span><?php echo $nombreCategoria?></span></h2>
            <div class="mas-productos">
        
            <?php
                if(isset($masProds) && is_array($masProds)){
                    foreach ($masProds as $producto){
                        if ($producto['productnoted'] == 1){
                            $tendencia = '
                            <span class="tendencia"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.963 2.286a.75.75 0 0 0-1.071-.136 9.742 9.742 0 0 0-3.539 6.176 7.547 7.547 0 0 1-1.705-1.715.75.75 0 0 0-1.152-.082A9 9 0 1 0 15.68 4.534a7.46 7.46 0 0 1-2.717-2.248ZM15.75 14.25a3.75 3.75 0 1 1-7.313-1.172c.628.465 1.35.81 2.133 1a5.99 5.99 0 0 1 1.925-3.546 3.75 3.75 0 0 1 3.255 3.718Z" clip-rule="evenodd" />
                          </svg>
                          Tendencia</span>
                        ';
                        }

                        echo"<article class='grid-productos'>";
                        echo '
                            <div>
                                '.$tendencia.'
                                <img src='.$producto['productimg'].' alt="imagen">
                            </div>
                            <div>
                                <a href="index.php?Controller=Productos&action=productoConcreto&productID='.$producto['productid'].'">'.$producto['productname'].'</a>
                            </div>
                            <div>
                                <span>'.$producto['productprice'].'€</span>
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
                        // echo"<img src='".$producto['productimg']."' alt='producto relacionado'>"; 
                        // echo"<p>".$producto['productname']."</p>";
                        // echo"<p>".$producto['productprice']."</p>";
                        // //Las lineas estan comentadas porque da error al recibir lo que recibe, cuando este bien implementado el crear producto deberia funcionar
                        // echo"<button onclick='anadirCarrito()'><img src='../../img/carro.jpg' alt='Aqui va el carrito'>Añadir</button>";
                        echo"</article>";
                     }
                }
            ?>
            </div>
        </section>
        <!-- <script src="../../js/productoConcreto.js"></script> -->
    </section>
    <section class="void"></section>
</main>


