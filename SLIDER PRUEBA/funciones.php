<?php
function conexion(){
    $conexion = mysqli_connect("localhost","root","","prueba slider");
    return $conexion;
}
function subirFoto($picture){
    $conexion=conexion();
    if(is_uploaded_file($picture)){    
        $directory= "img/" ;
        $fileName= $_FILES['photo']['name'];
        $idUnico=time();
        $path=$directory.$idUnico.$fileName;
        move_uploaded_file($picture,$path);
    }else{
        echo "<h1>Error, no se ha subido la imagen</h1>";
    }
    $query= "INSERT INTO  imagenes (ruta) VALUES (?)";
    $consulta = $conexion->prepare($query);
    $consulta->bind_param("s",$path);
    $consulta->execute();
}
function obtenerRutasImagenes() {
    $conexion = conexion();
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    $query = "SELECT ruta FROM imagenes";
    $resultado = mysqli_query($conexion, $query);
    if ($resultado) {
        $rutas = array();
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $rutas[] = $fila['ruta'];
        }
        mysqli_free_result($resultado);
        mysqli_close($conexion);
        return $rutas;
    } else {
        // Si la consulta falla, mostrar un mensaje de error
        echo "Error en la consulta: " . mysqli_error($conexion);
    }
    mysqli_close($conexion);
    return false;
    }

?>