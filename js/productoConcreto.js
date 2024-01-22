let inputCantidad = document.getElementById('cantidad');
let stockTotal = document.getElementById('stockMaximo')
console.log(stockTotal.value);
function incrementarCantidad() {
    let cantidadActual = parseInt(inputCantidad.value);
    inputCantidad.value = cantidadActual + 1;
}

function disminuirCantidad() {
    let cantidadActual = parseInt(inputCantidad.value);
    if (cantidadActual > 1) {
        inputCantidad.value = cantidadActual - 1;
    }
}

function anadirCarrito() {
    let nombreProducto = 'Nombre del Producto';
    let cantidad = parseInt(inputCantidad.value);
    alert(`Añadir ${cantidad} ${nombreProducto}(s) al carrito`);
    // Aqui ira la parte de codigo encargada de mandar la info al carrito (AJAX)
}

function mostrarOcultar(id) {
    var elemento = document.getElementById(id);
    if (elemento.style.display === 'none') {
      elemento.style.display = 'block';
    } else {
      elemento.style.display = 'none';
    }
}