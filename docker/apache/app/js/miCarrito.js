document.addEventListener('DOMContentLoaded', function() {
    
// Función para actualizar el resumen de la compra
function actualizarResumenCompra() {
    // Obtener todos los elementos de cantidad en el resumen
    const cantidadesResumen = document.querySelectorAll('.cantidad-resumen');
    // Obtener todos los elementos de precio total en el resumen
    const precioTotalProducto = document.querySelectorAll('.precio-total-producto');
    // Obtener todos los elementos de precio unitario en el resumen
    const preciosUnitarios = document.querySelectorAll('.precio-unitario');

    // Recorrer los productos en el resumen
    cantidadesResumen.forEach((cantidadElement, index) => {
        // Obtener la cantidad del producto
        const cantidadText = cantidadElement.textContent;
        console.log('Cantidad:', cantidadText); // Debugging
        const cantidad = parseFloat(cantidadText);
    
        // Obtener el precio unitario del producto del artículo correspondiente
        const precioUnitarioText = preciosUnitarios[index].textContent.replace('€', '').trim();
        const precioUnitario = parseFloat(precioUnitarioText);
        console.log('Precio unitario:', precioUnitarioText); // Debugging
    
        // Verificar si los valores son números válidos
        console.log('Es cantidad un número válido:', !isNaN(cantidad));
        console.log('Es precio unitario un número válido:', !isNaN(precioUnitario));
    
        // Calcular el precio total del producto si los valores son números válidos
        if (!isNaN(cantidad) && !isNaN(precioUnitario)) {
            const precioTotal = cantidad * precioUnitario;
            console.log('Precio total:', precioTotal); // Debugging
    
            // Actualizar el precio total del producto en el resumen
            precioTotalProducto[index].textContent = precioTotal.toFixed(2) + '€';
        } else {
            console.error('La cantidad o el precio unitario no son números válidos.');
        }
    });

    // Actualizar el total de la compra en el resumen
    actualizarPrecioResumen();
}


    // Función para actualizar el precio total de la compra en el resumen
    function actualizarPrecioResumen() {
        var elementosPrecioTotalProducto = document.querySelectorAll('.precio-total-producto');
        var totalCompra = 0;

        elementosPrecioTotalProducto.forEach(function(elemento) {
            var precioProducto = elemento.textContent.replace('€', '').trim();
            totalCompra += parseFloat(precioProducto);
        });
        
        document.getElementById('precio-total-compra').textContent = totalCompra.toFixed(2) + '€';
    }

    // Función para actualizar las cantidades en el resumen
    function actualizarCantidadResumen() {
        // Obtener todos los elementos de cantidad en el resumen
        const cantidadesResumen = document.querySelectorAll('.cantidad-resumen');
        // Obtener todos los inputs de cantidad en la página
        const inputsCantidad = document.querySelectorAll('.cantidad');

        // Recorrer los inputs de cantidad y actualizar los elementos en el resumen
        inputsCantidad.forEach((input, index) => {
            cantidadesResumen[index].textContent = input.value;
        });
    }

    // Delegación de eventos para manejar cambios en la cantidad
    document.getElementById('resumen-compra').addEventListener('input', function(event) {
        if (event.target && event.target.classList.contains('cantidad')) {
            // Actualizar el resumen del carrito
            actualizarCantidadResumen();
            actualizarResumenCompra();
        }
    });

    // Llamar a la función inicialmente para sincronizar las cantidades
    actualizarCantidadResumen();
    actualizarResumenCompra();
    

    // Función para eliminar un producto del carrito y actualizar la vista
    function eliminarProducto(event) {
        // Obtener el artículo que contiene la información del producto
        var productoElemento = event.target.closest('.item-carrito');

        // Eliminar el elemento HTML correspondiente al producto eliminado
        productoElemento.remove();

        // Actualizar el resumen del carrito
        generarResumenCarrito(carrito);
        generarContenidoCarrito(carrito);
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

