import Carrito from './carrito.js';
import Carrito2 from './carrito.js';

const btnAnadirCarrito = document.getElementById('btnAnadir');
let inputCantidad = document.getElementById('cantidad');
let nombreProducto = document.getElementById('nombreProd');
let precioProducto = document.getElementById('precioProducto');
let productoID = document.getElementById('idDelProducto');
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

// function anadirCarrito() {
//     let temp = document.getElementById('nombreProd');
//     let nombreProducto =  temp.value;
//     let cantidad = parseInt(inputCantidad.value);
//     alert(`Añadir ${cantidad} ${nombreProducto}(s) al carrito`);
//     // Aqui ira la parte de codigo encargada de mandar la info al carrito (AJAX)
// }

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

let carrito = sessionStorage.getItem('carrito');
carrito = carrito ? JSON.parse(carrito) : {};
btnAnadirCarrito.addEventListener('click', function () {
    // Obtener los valores de los elementos
    let nombreProductoValue = nombreProducto.value;
    let precioProductoValue = parseFloat(precioProducto.value);
    let inputCantidadValue = parseInt(inputCantidad.value);
    let productoIDValue = productoID.value;
    // Verificar si ya existe el producto en el carrito
    if (carrito.hasOwnProperty(nombreProductoValue)) {
        // Si existe, agregar la cantidad
        carrito[nombreProductoValue].cantidad += inputCantidadValue;
    } else {
        // Si no existe, agregar un nuevo producto al carrito
        carrito[nombreProductoValue] = {
            id: productoIDValue,
            cantidad: inputCantidadValue
        };
    }
    // Convertir el carrito a una cadena JSON y almacenarlo en sessionStorage
    let carritoJSON = JSON.stringify(carrito);
    sessionStorage.setItem('carrito', carritoJSON);
    let obtenerCarrito = sessionStorage.getItem('carrito');
    carrito = new Carrito(obtenerCarrito);
    carrito.ajaxCosas();
});
const buttonComprarYa = document.getElementById('comprarYa');
buttonComprarYa.addEventListener('click', function(){
    let obtenerCarrito = sessionStorage.getItem('carrito');
    carrito = new Carrito(obtenerCarrito);
    carrito.ajaxCosas();
});