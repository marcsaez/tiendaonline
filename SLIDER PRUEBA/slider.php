<!doctype html>
<?php
include('funciones.php');
?>
<html lang="es">
    <head>
        <meta lang="es" />
        <meta charset="utf-8" />
        <title>Slider con CSS y PHP</title>
        <link href="slider.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="slider">
            <?php
                $ids = obtenerRutasImagenes();
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
                <?php }
            ?>
            <div class="slideshow">
                <?php for($s=0;$s<$max;$s++){ ?>
                <div class="item-slide">
                    <img src="<?= $ids[$s]; ?>" alt="<?= $alt[$s]; ?>" />
                </div>
                <?php } ?>
            </div>
            <div class="pagination">
                <?php for($s=0;$s<$max;$s++){ ?>
                <label class="pag-item" for="<?= $ids[$s]; ?>">
                    <img src="<?= $ids[$s]; ?>" alt="<?= $alt[$s]; ?>" />
                </label>
                <?php } ?>
            </div>
        </div>
    </body>
</html>