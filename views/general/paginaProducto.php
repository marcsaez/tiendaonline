<div>
    <ul>
        <li><a href="index.php">Inicio</a></li>
    </ul>
</div>
<div>
    <script src="js/productoConcreto.js"></script>
    <img src="<?php echo $productoConcreto[0]['productimg'];?>" alt="Foto del producto">
    <h2><?php echo $productoConcreto[0]['productname'];?></h2>
    <p><?php echo ($productoConcreto[0]['productprice']+3); ?>€</p>
    <h2><?php echo $productoConcreto[0]['productprice']; ?>€</h2>
    <p>Ref: <?php echo $productoConcreto[0]['productid']; ?></p>
    <h1>Disponibilidad: </h1>
    <?php
    if($productoConcreto[0]['productstock']>10){
        echo"<p>En sotck</p>";//El css sera verde
    }elseif($productoConcreto[0]['productstock']<=10 && $productoConcreto[0]['productstock']>0){
        echo"<p>".$productoConcreto[0]['productstock']."</p>";//El css en naranja
    }elseif($productoConcreto[0]['productstock']==0){
        echo"<p>Sin sotck</p>";//El css en rojo
    }   
    ?>
    <h2>Cantidad</h2>
    <div class="containerCantidad">
        <button onclick="disminuirCantidad()">-</button>
        <input type="text" id="cantidad" value="1" readonly>
        <button onclick="incrementarCantidad()">+</button>
    </div>
    <button onclick="anadirCarrito()"><img src="../../img/carrito.png" alt="Aqui va el carrito">Añadir</button>
    <h2>Descricpion</h2>
    <h2 onclick="mostrarOcultar('descripcionProd')">+</h2>
    <div id="descripcionProd" style="display:none;">
        <p><?php echo $productoConcreto[0]['productdescription']; ?></p>
    </div>
    <h2>Mas info</h2>
    <h2 onclick="mostrarOcultar('masInfoProducto')">+</h2>
    <div id="masInfoProducto" style="display:none;">
        <h3>Categoria: </h3>
        <p><?php echo $nombreCategoria?></p>
        <?php 
        // if(isset($subcategoria)){ ?>
            <!-- <h3>Genero: </h3>
            ?php echo $subcategoria ?>
         <?php
        // }
        // ?>
    </div>
</div>
<div>
    <h2>Mas <?php echo $subcategoria?></h2>
    <?php
        if(isset($masProductos) && is_array($masProductos)){
            foreach ($masProductos as $producto){
                echo"<div>";
                // echo"<img src='$producto['productimg']' alt='producto relacionado'>"; 
                // echo"<p>$producto['productname']</p>";
                // echo"<p>$producto['productprice']</p>";
                //Las lineas estan comentadas porque da error al recibir lo que recibe, cuando este bien implementado el crear producto deberia funcionar
                echo"<button onclick='anadirCarrito()'><img src='../../img/carro.jpg' alt='Aqui va el carrito'>Añadir</button>";
                echo"</div>";
            }
        }
    ?>
</div>
<script src="../../js/productoConcreto.js"></script>