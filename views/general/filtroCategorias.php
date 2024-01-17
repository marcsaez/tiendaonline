<?php
echo '
<div id='.$id.'>
    <h1>Estás buscando '.$nombre.'</h1>
</div>

';
if (isset($subcat) && is_array($subcat)){
    foreach ($subcat as $sub) {
        $subid = $sub['categoryid'];
        $subname = $sub['categoryname'];
        $subfather = $sub['fkfathercategory'];
        echo '
        <div id="'.$subname.'">
            <a id="'.$subname.'" href="index.php?Controller=Categorias&action=filtrar&categoria='.$subid.'&nombre='.$subname.'">'.$subname.'</a>
        </div>
        ';

    }
}



?>