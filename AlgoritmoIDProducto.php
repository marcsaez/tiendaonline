<?php
//A esta funcion para implementarla habra que pasarle los parametros que requiera 
//la funcion de insert, ya que se llamara dentro de esta para poder insertar con el codigo
function generarCodigoUnico($categoria, $nombre, $numero, $longitudCategoria = 2, $longitudNombre = 2) {
    $codigoCategoria = substr(strtoupper($categoria), 0, $longitudCategoria);
    $codigoNumero = str_pad($numero, 3, '0', STR_PAD_LEFT);
    $codigoNombre = substr(strtoupper($nombre), 0, $longitudNombre);
    $codigoUnico = $codigoCategoria . $codigoNumero . '-' . $codigoNombre;
    //funcion insertar 
    return $codigoUnico;
}
//El parametro numero de la funcion generar se crea con esta funcion de aqui,
//por lo que en vez de pasarlo como parametro en la funcion de arriba se 
//llamara a la funcion dentro y se le asignara la variable $numero
function obtenerSiguienteNumeroProducto() {
    $conexion = pg_connect("host=localhost dbname=nombre_base_de_datos user=usuario password=contraseña");
    if (!$conexion) {
        die("Error de conexión: " . pg_last_error());
    }
    $query = "SELECT COUNT(*) as total FROM products";
    $resultado = pg_query($conexion, $query);
    if ($resultado) {
        $fila = pg_fetch_assoc($resultado);
        $siguienteNumero = $fila['total'] + 1;
        pg_free_result($resultado);
        pg_close($conexion);
        return $siguienteNumero;
    } else {
        echo "Error en la consulta: " . pg_last_error($conexion);
    }
    pg_close($conexion);  
    return false;
}
 
//Esto es solo un ejemplo
$categoria = "Electrónica";
$nombre = "Smartphone";
$numero = obtenerSiguienteNumeroProducto();

$codigoGenerado = generarCodigoUnico($categoria, $nombre, $numero);
echo "Código único generado: " . $codigoGenerado;