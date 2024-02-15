<?php 
if (isset($result) && is_array($result)){
require './vendor/autoload.php';
ob_clean();
$nombre = $datosCustomer["customername"];
$email = $datosCustomer["email"];
$telefono = $datosCustomer["customerphone"];
$direccion = $datosCustomer["customeraddress"];
$html2pdf = new \Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en');
$content =  '<page>';
$content .= '<h1>Factura</h1>';
$content .= '<h3>Datos del cliente</h3>';
$content .= '<table><tr><th>Nombre:</th><td>'.$nombre .'</td></tr>';
$content .= '<tr><th>Direccion:</th><td>'.$direccion.'</td></tr>';
$content .= '<tr><th>Email:</th><td>'.$email.'</td></tr>';
$content .= '<tr><th>Telefono:</th><td>'.$telefono.'</td></tr>';
$content .= '</table>';
$content .= '<h3>Productos</h3><br/>';
$content .= '<table class="admin-table">';
$content .= '<tr><th>ID</th><th>Nombre</th><th>Cantidad</th><th>Precio Total</th></tr>';
$totalPriceSum = 0;
foreach ($result as &$value) {
    $totalPriceSum += $value['totalprice'];
    $content .= '<tr>';
    $content .= '<td>'.$value['fkproduct'].'</td>';
    $content .= '<td>'.$value['productname'].'</td>';
    $content .= '<td>'.$value['amount'].' unidades</td>';
    $content .= '<td>'.$value['totalprice'].'€</td>';
    $content .= '</tr>';
}
$content .= '<tr><th colspan="3">Total</th><th>'.$totalPriceSum.'€</th></tr>';
$content .= '</table>';
$content .= '<page_footer>';
$content .= '<h3>Administrator signature:</h3><br/>';
$content .= '<img src="./img/firmas/imagen_canvas.png" alt="Administrator signature" style="width:200px;height:200px;">';
$content .= '</page_footer></page>';
$html2pdf->writeHTML($content);
$html2pdf->output('purchase-details.pdf');
}