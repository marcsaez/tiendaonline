document.addEventListener('DOMContentLoaded', function() {
    var elementosPrecioTotalProducto = document.querySelectorAll('.precio-total-producto');
    var totalCompra = 0;

    elementosPrecioTotalProducto.forEach(function(elemento) {
        var precioProducto = elemento.textContent.replace('€', '').trim();
        totalCompra += parseFloat(precioProducto);
    });

    document.getElementById('precio-total-compra').textContent = totalCompra.toFixed(2) + '€';
});