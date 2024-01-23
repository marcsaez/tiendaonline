<div id="slider"></div>     
<main class="page-grid" id="index">
    <div class="void"></div>
    <div>
        <section>
            <h2><img src="././img/trending.png" alt="fueguito">TOP TENDENCIAS DE ESTE MES</h2>
            <div class="warp">
                <!-- <div class="top-card"></div> -->
                <?php
                $vuelta=1;
                    foreach ($productosDestacados as $producto){
                        echo"<div class='top-card'>";
                            echo "<h2>Top $vuelta </h2>";
                            echo "<img src='".$producto['productimg']."' alt='Producto Destacado' width=60px height=60px>";
                            echo "<a href='index.php?Controller=Productos&action=productoConcreto&productID=".$producto['productid']."'>".$producto['productname']."</a>";
                            echo "<p>".$producto['productdescription']."</p>";
                            echo "<button><img src='././img/carrito.png' alt='carro'>Añadir</button>";
                        echo"</div>";
                        $vuelta=$vuelta+1;
                    }
                ?>
                
            </div>
        </section>
        <section>
            <h2>ENCUENTRA LO QUE MÁS TE GUSTA</h2>
            <div>
                <a href="#"><img src="././img/grid-one-piece-2.jpg" alt="novedades"><span>novedades</span> </a>
                <a href="#"><img src="././img/DBPanel.webp" alt="manga"><span>manga</span></a>
                <a href="#"><img src="././img/solo-leveling.png" alt="manhwa"><span>manhwa</span></a>
                <a href="#"><img src="././img/grid-juego.png" alt="juegos-de-mesa"><span>juegos de mesa</span></a>
                <a href="#"><img src="././img/grid-merch.png" alt="merchandising"><span>merchandising</span></a>
            </div>
        </section>
    </div>
    <div class="void"></div>
</main>
