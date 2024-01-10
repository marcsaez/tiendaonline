<div>
    <div>
        <h2><img src="././img/trending.png" alt="fueguito">TOP TENDENCIAS DE ESTE MES</h2>
        <div>
            <?php
            $vuelta=1;
                foreach ($productosDestacados as $producto){
                    echo"<div>";
                        echo "<img src='".$producto['productimg']."' alt='Producto Destacado'>";
                        echo "<h2>Top $vuelta </h2>";
                        echo "<a href=''>".$producto['productname']."</a>";
                        echo "<p>".$producto['productdescription']."</p>";
                        echo "<button><img src='././img/carrito.png' alt='carro'>Añadir</button>";
                    echo"</div>";
                }
            ?>
        </div>
    </div>
    <div>
        <h2>ENCUENTRA LO QUE MÁS TE GUSTA</h2>
        <a href="#"><div>Novedades</div> </a>
        <a href="#"><div>Manga</div></a>
        <a href="#"><div>Manhwa</div></a>
        <a href="#"><div>Merchandaising</div></a>
        <a href="#"><div>Juegos de Mesa</div></a>
    </div>
</div>