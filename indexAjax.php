<?php
    require_once "autoload.php";
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
            //require_once "views/admin/loginAdmin.php";
            $action ="";
        }
        $controlador->$action();   
    }else{
    
        echo "No existe el controlador";
    }
?>