<main class="page-grid">
    <section class="void"></section>
    <section class="pagina-producto">

        <section>
            <ul>
                <li><a href="index.php">Inicio</a></li>
            </ul>
        </section>
        <section>
            <img src="<?php echo $productoConcreto[0]['productimg'];?>" alt="Foto del producto">
        </section>
        <section>
            <input type="hidden" name="stockMaximo" id="stockMaximo" value="<?php echo $productoConcreto[0]['productstock']; ?>">
            <input type="hidden" name="nombreProd" id="nombreProd" value="<?php  echo $productoConcreto[0]['productname'];?>">
            <div>
                <h1><?php echo $productoConcreto[0]['productname'];?></h1>
                <div>
                    <span><?php echo ($productoConcreto[0]['productprice']+3); ?>€</span>
                    <h1><?php echo $productoConcreto[0]['productprice']; ?>€</h1>
                </div>
            </div>
            <section>
                <div>
                    <span>Ref: <?php echo $productoConcreto[0]['productid']; ?></span>
                    <p>Disponibilidad:
                    <?php
                        if($productoConcreto[0]['productstock']>0){
                            echo"<span id='si-stock'>En sotck</span>";//El css sera verde
                        }
                        else{
                            echo"<span id='no-stock'>Sin sotck</span>";//El css en rojo
                        }
                    ?> </p>
                </div>
                
                <button>Comprar ya</button>
            </section>
            <article>
                <h2>Cantidad</h2>
                <div class="containerCantidad">
                    <button onclick="disminuirCantidad()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                        </svg>
                    </button>
                    <input type="text" id="cantidad" value="1" readonly>
                    <button onclick="incrementarCantidad()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>

                    </button>
                </div>
                <button onclick="anadirCarrito()"><img src="../../img/carrito.png" alt="Aqui va el carrito">Añadir</button>
            </article>
            <article>
                <div class="producto-info">
                    <h2>Descricpion</h2>
                    <span onclick="mostrarOcultar('descripcionProd')">+</span>
                </div>
                <div id="descripcionProd" style="display:none;">
                    <p><?php echo $productoConcreto[0]['productdescription']; ?></p>
                </div>
            </article>
            <article>
                <div class="producto-info">
                    <h2>Mas info</h2>
                    <span onclick="mostrarOcultar('masInfoProducto')">+</span>
                    <div id="masInfoProducto" style="display:none;">
                        <h3>Categoria: </h3>
                        <p><?php echo $nombreCategoria?></p>
                        <?php 
                        // if(isset($subcategoria)){
                            //<h3>Genero: </h3>
                            //echo $subcategoria
                        
                        // }
                        // 
                        ?>
                    </div>
                </div>
            </article>
        </section>
        <section>
            <h2>Mas <?php //echo $subcategoria?></h2>
            <?php
                // if(isset($masProductos) && is_array($masProductos)){
                //     foreach ($masProductos as $producto){
                //         echo"<div>";
                //         echo"<img src='$producto['productimg']' alt='producto relacionado'>"; 
                //         echo"<p>$producto['productname']</p>";
                //         echo"<p>$producto['productprice']</p>";
                //         Las lineas estan comentadas porque da error al recibir lo que recibe, cuando este bien implementado el crear producto deberia funcionar
                //         echo"<button onclick='anadirCarrito()'><img src='../../img/carro.jpg' alt='Aqui va el carrito'>Añadir</button>";
                //         echo"</div>";
                //     }
                // }
            ?>
        </section>
        <!-- <script src="../../js/productoConcreto.js"></script> -->
    </section>
    <section class="void"></section>
</main>
<script src="./js/productoConcreto.js"></script>
