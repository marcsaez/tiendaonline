<?php
// Obtener la imagen codificada desde la solicitud POST
$imagen_codificada = $_POST['imagen'];
$email = $_POST['email'];
echo "$imagen_codificada";

// Decodificar la imagen base64
$imagen_decodificada = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagen_codificada));

// Ruta donde deseas guardar la imagen (NOMBRE SERA LA ID DE LA FACTURA)
$ruta_guardado = '../../img/firmas/' . $email . '_factura.png';
// Guardar la imagen en el servidor
file_put_contents($ruta_guardado, $imagen_decodificada);

echo 'Imagen guardada correctamente en ' . $ruta_guardado;
?>
