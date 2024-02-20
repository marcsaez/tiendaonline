document.addEventListener('DOMContentLoaded', function() {
    var elementosPrecioTotalProducto = document.querySelectorAll('.precio-total-producto');
    var totalCompra = 0;

    elementosPrecioTotalProducto.forEach(function(elemento) {
        var precioProducto = elemento.textContent.replace('€', '').trim();
        totalCompra += parseFloat(precioProducto);
    });

    document.getElementById('precio-total-compra').textContent = totalCompra.toFixed(2) + '€';

    let inputCantidad = document.getElementById('cantidad');
    let stockTotal = document.getElementById('stockMaximo');
    
    function ajustarCantidad(incremento) {
        let cantidadActual = parseInt(inputCantidad.value);
        let stockMax = parseInt(stockTotal.value);
    
        if (incremento && cantidadActual < stockMax) {
            inputCantidad.value = cantidadActual + 1;
        } else if (!incremento && cantidadActual > 1) {
            inputCantidad.value = cantidadActual - 1;
        }
    }
    
    const restarCantidadBtn = document.getElementById('restar-cantidad');
    const sumarCantidadBtn = document.getElementById('sumar-cantidad');
    
    restarCantidadBtn.addEventListener('click', () => ajustarCantidad(false));
    sumarCantidadBtn.addEventListener('click', () => ajustarCantidad(true));
    
    restarCantidadBtn.addEventListener('mousedown', () => {
        intervalId = setInterval(() => ajustarCantidad(false), 200); // Llama a ajustarCantidad(false) cada 200 ms
    });
    
    sumarCantidadBtn.addEventListener('mousedown', () => {
        intervalId = setInterval(() => ajustarCantidad(true), 200); // Llama a ajustarCantidad(true) cada 200 ms
    });

});


document.addEventListener('DOMContentLoaded', function() {
    // Función para eliminar un producto del carrito y actualizar la vista
    function eliminarProducto(event) {
        // Obtener el artículo que contiene la información del producto
        var productoElemento = event.target.closest('.item-carrito');

        // Eliminar el elemento HTML correspondiente al producto eliminado
        productoElemento.remove();

        // Actualizar el resumen del carrito
        generarResumenCarrito(carrito);
    }

    // Delegación de eventos para manejar clics en los botones de eliminar
    document.getElementById('resumen-compra').addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('action-eliminar')) {
            eliminarProducto(event);
        }
    });
});
function eliminarUnProducto(){
    console.log(this.diccionario);
    $.ajax({
        url: 'indexAjax.php?Controller=Carrito&action=deletePurchase',
        type: 'POST',
        contentType: 'application/json; charset=UTF-8',
        data: JSON.stringify({ carrito: this.diccionario}),
        success: function (data) {
            console.log(data);
            // Maneja la respuesta del servidor
            if (data.success) {
                console.log('Okay');
                // console.log(data);
            } else {
                console.error('Error en la solicitud:', data.message);
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            // Maneja el error
            console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            console.error('Estado de la respuesta:', xhr.status);
            console.error('Respuesta del servidor:', xhr.responseText);
        }
    });
}

