<script type="module" src="./js/productoConcreto.js"></script>
<div class="slider">
    <?php
        $ids = array(1,2,3,4,5);
        $alt = array(
            "Slide 1",
            "Slide 2",
            "Slide 3",
            "Slide 4",
            "Slide 5"
        );
        $max = count($ids);
        for($s=0;$s<$max;$s++){ ?>
            <input type="radio" id="<?= $ids[$s]; ?>" name="image-slide" hidden />
    <?php } ?>
    <div class="slideshow">
        <?php for($s=0;$s<$max;$s++){ ?>
        <div class="item-slide">
            <img src="img/<?= $ids[$s]; ?>.jpg" alt="<?= $alt[$s]; ?>" />
        </div>
        <?php } ?>
    </div>
    <div class="pagination">
        <?php for($s=0;$s<$max;$s++){ ?>
        <label class="pag-item" for="<?= $ids[$s]; ?>">
            <img src="img/<?= $ids[$s]; ?>.jpg" alt="<?= $alt[$s]; ?>" />
        </label>
        <?php } ?>
    </div>
</div> 
<main class="page-grid" id="index">
    <div class="void"></div>
    <div>
        <section>
            <fieldset class="tendencias">
                <legend>TOP TENDENCIAS DE ESTE MES</legend>
                <section class="warp">
                    
                    <?php
                        $vuelta=1;
                        foreach ($productosDestacados as $producto){
                            echo "<article class='top-card'>";
                            
                            echo "<div><img src='".$producto['productimg']."' alt='Producto Destacado' width=60px height=60px></div>";
                                echo "<div><h3><svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor'>
                                <path stroke-linecap='round' stroke-linejoin='round' d='M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0' />
                              </svg>
                              TOP $vuelta </h3>
                                <a href='index.php?Controller=Productos&action=productoConcreto&productID=".$producto['productid']."'>
                                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='black' id='visit-page'>
                                <path stroke-linecap='round' stroke-linejoin='round' d='M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25' />
                                </svg>
                                </a>
                              </div>";
                                echo "<div><a href='index.php?Controller=Productos&action=productoConcreto&productID=".$producto['productid']."'>".$producto['productname']."</a>";
                                echo "<p>".$producto['productdescription']."</p></div>";
                                echo '<div><button class="btn-primary';
                                if(isset($_SESSION['userType']) && $_SESSION['userType']=='usuario'){
                                    echo' btn-addOne';
                                }else{
                                    echo' btn-addOneNoLog';
                                }
                                echo '"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                              </svg> 
                              Añadir</button></div>';
                                echo '<input type="hidden" name="imgAddOne" id="imgAddOne" value="'.$producto['productimg'].'">';
                                echo '<input type="hidden" name="priceAddOne" id="priceAddOne" value="'.$producto['productprice'].'">';
                                echo '<input type="hidden" name="idAddOne" id="idAddOne" value="'.$producto['productid'].'">';
                                echo '<input type="hidden" name="nombreAddOne" id="nombreAddOne" value="'.$producto['productname'].'">';
                            echo"</article>";
                            $vuelta=$vuelta+1;
                        }
                    ?>
                    
                </section>
            </fieldset>
        </section>
        <section>
            <h2>ENCUENTRA LO QUE MÁS TE GUSTA</h2>
            <div>
                <a href=""><img src="././img/grid-one-piece-2.jpg" alt="novedades"><span>novedades</span> </a>
                <a href="index.php?Controller=Categorias&action=filtrar&categoria=8&nombre=Manga"><img src="././img/DBPanel.webp" alt="manga"><span>manga</span></a>
                <a href="#"><img src="././img/solo-leveling.png" alt="manhwa"><span>manhwa</span></a>
                <a href="#"><img src="././img/grid-juego.png" alt="juegos-de-mesa"><span>juegos de mesa</span></a>
                <a href="#"><img src="././img/grid-merch.png" alt="merchandising"><span>merchandising</span></a>
            </div>
        </section>
    </div>
    <div class="void"></div>
</main>

