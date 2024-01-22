<?php
echo '
<div id='.$id.'>
    <h1>Estás buscando '.$nombre.'</h1>
</div>

';
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
}

// PRODUCTOS
if (isset($products) && is_array($products)){
    echo '<div class="productos">';
    foreach ($products as $prod){
        $prodid = $prod['productid'];
        $prodname = $prod['productname'];
        $proddescription = $prod['productdescription'];
        $prodimg = $prod['productimg'];
        $prodstock = $prod['productstock'];
        $prodnoted = $prod['productnoted'];
        $prodprice = $prod['productprice'];
        $prodcat = $prod['fkcategories'];
        echo '<div class="'.$prodname.'">';
        echo '<img src="'.$prodimg.'" alt="'.$proddescription.'" width=100px height=100px>';
        echo "<a href='index.php?Controller=Productos&action=productoConcreto&productID=".$prod['productid']."'>".$prod['productname']."</a>";
        echo '</div>';
    }
    echo '</div>';
}

?>