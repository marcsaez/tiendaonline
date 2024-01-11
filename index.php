<!--Controlador frontal: fichero que se encarga de cargarlo absolutamente todo -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='css/main.css'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>MangaHouse</title>
</head>
<body>
<?php 
session_start();
require_once "autoload.php";

if(isset($_SESSION['admin_id'])){
    require_once 'views/admin/navLateral.php';
} else {
    CategoriasController::menuCategorias();
}

if (isset($_GET['Controller'])){
    $nombreController = $_GET['Controller']."Controller";
}
else{
    //Controlador per dedecte
    $nombreController = "AdminController";
    
}
if (class_exists($nombreController)){
    $controlador = new $nombreController(); 
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }
    else{
        ProductosController::mostrarPrincipal();
        $action ="";
    }
    if (isset($action) && method_exists($controlador, $action)) {
        $controlador->$action();
    } else {
        ProductosController::mostrarPrincipal();
        $action = "";
    }  
}else{

    echo "No existe el controlador";
}
?>

<?php 
require_once "views/general/pies.php";
?>
</body>
</html>


