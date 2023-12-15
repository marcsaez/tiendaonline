<div>
    <ul>
        <li><a href="index.php?Controller=User&action=paginaInicio">Inicio</a></li>
    </ul>
</div>
<div>
    <img src="<?php echo $imagen?>" alt="Foto del producto">
    <h2><?php echo $nombreProducto ?></h2>
    <p><?php echo ($precioProducto+1) ?></p>
    <h2><?php echo $precioProducto ?></h2>
    <p><?php echo $codigoProducto ?></p>
    <h1>Disponibilidad: </h1>
    <?php
    if($stockProducto>10){
        echo"<p>En sotck</p>";//El css sera verde
    }elseif($stockProducto<=10 && $stockProducto>0){
        echo"<p>$stockProducto</p>";//El css en naranja
    }elseif($sotckProducto==0){
        echo"<p>Sin sotck</p>";//El css en rojo
    }   
    ?>
    <h2>Cantidad</h2>
    <div class="containerCantidad">
        <button onclick="disminuirCantidad()">-</button>
        <input type="text" id="cantidad" value="1" readonly>
        <button onclick="incrementarCantidad()">+</button>
    </div>
    <button onclick="anadirCarrito()"><img src="../../img/carro.jpg" alt="Aqui va el carrito">Añadir</button>
    <h2>Descricpion</h2>
    <h2 onclick="mostrarOcultar('descripcionProd')">+</h2>
    <div id="descripcionProd" style="display:none;">
        <p><?php echo $descripcionProducto ?></p>
    </div>
    <h2>Mas info</h2>
    <h2 onclick="mostrarOcultar('masInfoProducto')">+</h2>
    <div id="masInfoProducto" style="display:none;">
        <h3>Categoria: </h3>
        <p><?php echo $categoria ?></p>
        <?php if(isset($subcategoria)){ ?>
            <h3>Genero: </h3>
            <p><?php echo $subcategoria ?></p>
        <?php }?>
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