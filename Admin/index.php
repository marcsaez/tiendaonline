<!--Controlador frontal: fichero que se encarga de cargarlo absolutamente todo -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='../css/styles.css'>
    <title>MangaHouse</title>
</head>
<body>
<?php 
require_once "autoload.php";
require_once "../views/general/headeradmin.php";
require_once "../views/admin/loginAdmin.php";

/*if (isset($_GET['controller'])){
    $nombreController = $_GET['controller']."Controller";
}
else{
    //Controlador per dedecte
    $nombreController = "UsuarioController";
}
if (class_exists($nombreController)){
    $controlador = new $nombreController(); 
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }
    else{
        $action ="mostrarTodos";
    }
    $controlador->$action();   
}else{

    echo "No existe el controlador";
}
*/
//require_once "../views/general/pies.php";
?>
</body>
</html>


