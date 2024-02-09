import Carrito from './carrito.js';

const btnAnadirCarrito = document.getElementById('btnAnadir');
let inputCantidad = document.getElementById('cantidad');
let nombreProducto = document.getElementById('nombreProd');
let precioProducto = document.getElementById('precioProducto');
let productoID = document.getElementById('idDelProducto');
let stockTotal = document.getElementById('stockMaximo');


let intervalId; // Variable global para almacenar el ID del intervalo

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

// Detener la acción cuando se suelta el botón
document.addEventListener('mouseup', () => {
    clearInterval(intervalId); // Detiene la repetición cuando se suelta el botón
});


const imagenContainer = document.querySelector('.imagen-container');
const imagen = document.querySelector('.imagen-container img');
let isDragging = false;
let startCoords = { x: 0, y: 0 };
let startOffset = { x: 0, y: 0 };

imagenContainer.addEventListener('mousemove', e => {
    if (isDragging) {
        const offsetX = e.clientX - startCoords.x;
        const offsetY = e.clientY - startCoords.y;
        const newOffsetX = startOffset.x + offsetX;
        const newOffsetY = startOffset.y + offsetY;

        imagen.style.transform = `translate(${newOffsetX}px, ${newOffsetY}px)`;
    }
});

imagenContainer.addEventListener('mousedown', e => {
    isDragging = true;
    startCoords = { x: e.clientX, y: e.clientY };
    startOffset = { x: imagen.offsetLeft, y: imagen.offsetTop };
});

imagenContainer.addEventListener('mouseup', () => {
    isDragging = false;
});

imagenContainer.addEventListener('mouseleave', () => {
    isDragging = false;
    imagen.style.transform = 'none'; // Restablecer la transformación
});





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
            descripcionProd.classList.toggle('active');
        }
    });
});

let carrito = sessionStorage.getItem('carrito');
carrito = carrito ? JSON.parse(carrito) : {};
btnAnadirCarrito.addEventListener('click', function () {
    // Obtener los valores de los elementos
    let nombreProductoValue = nombreProducto.value;
    let inputCantidadValue = parseInt(inputCantidad.value);
    let productoIDValue = productoID.value;
    // Obtener el carrito del sessionStorage
    let carrito = sessionStorage.getItem('carrito');
    carrito = carrito ? JSON.parse(carrito) : {};
    // Verificar si ya existe el producto en el carrito
    if(carrito.hasOwnProperty(nombreProductoValue)) {
        // Si existe, agregar la cantidad
        carrito[nombreProductoValue].cantidad += inputCantidadValue;
    } else {
        // Si no existe, agregar un nuevo producto al carrito
        carrito[nombreProductoValue] = {
            id: productoIDValue,
            cantidad: inputCantidadValue
        };
    }
    // Almacenar el carrito en el sessionStorage
    sessionStorage.setItem('carrito', JSON.stringify(carrito));
    let obtenerCarrito = sessionStorage.getItem('carrito');
    carrito = new Carrito(obtenerCarrito);
    carrito.ajaxCosas();
});
document.addEventListener('DOMContentLoaded', function(){
    const buttonComprarYa = document.getElementById('comprarYa');
    if(buttonComprarYa != null){
    buttonComprarYa.addEventListener('click', function(){
        let obtenerCarrito = sessionStorage.getItem('carrito');
        carrito = new Carrito(obtenerCarrito);
        carrito.ajaxCosas();
        });
    }
    const userBtn = document.getElementById('comprarYaNoLogeado');
    if(userBtn!=null){
        const popUpContainer = document.getElementById('popup-container');
        userBtn.addEventListener('click', function(){
            popUpContainer.style.display = 'block';
        });
        popUpContainer.addEventListener('click', function(event){
            if(event.target === popUpContainer){
                popUpContainer.style.display = 'none';
            }
        });
    }
});