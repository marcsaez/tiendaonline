let inputCantidad = document.getElementById('cantidad');
let stockTotal = document.getElementById('stockMaximo');
function incrementarCantidad(){
    let cantidadActual = parseInt(inputCantidad.value);
    let stockMax = parseInt(stockTotal.value);
    if (cantidadActual < stockMax) {
        inputCantidad.value = cantidadActual + 1;
    }
}

function disminuirCantidad() {
    let cantidadActual = parseInt(inputCantidad.value);
    if (cantidadActual > 1) {
        inputCantidad.value = cantidadActual - 1;
    }
}

function anadirCarrito() {
    let temp = document.getElementById('nombreProd');
    let nombreProducto =  temp.value;
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

const plusMinusButtons = document.querySelectorAll('.plusminus');

plusMinusButtons.forEach(plusMinusButton => {
    plusMinusButton.addEventListener('click', (e) => {
        const descripcionProd = plusMinusButton.closest('article').querySelector('.descripcionProd');
        e.target.classList.toggle('active');
        if (descripcionProd) {
            //descripcionProd.style.display = (descripcionProd.style.display === 'none' || descripcionProd.style.display === '') ? 'block' : 'none';
            descripcionProd.classList.toggle('active');
        }
    });
});


