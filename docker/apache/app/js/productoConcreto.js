import Carrito from './carrito.js';
const btnAnadirCarritoNoLog = document.getElementById('btnAnadirNoLog');
const btnAnadirCarrito = document.getElementById('btnAnadir');
const btnAddOne = document.querySelectorAll('.btn-addOne');
const btnAddOneNoLog = document.querySelectorAll('.btn-addOneNoLog');
let productIdAddOne = document.getElementById('idAddOne');
let productNombreAddOne = document.getElementById('nombreAddOne');
let precioProducto = document.getElementById('precioProducto');
let inputCantidad = document.getElementById('cantidad');
let nombreProducto = document.getElementById('nombreProd');
let productoID = document.getElementById('idDelProducto');
let stockTotal = document.getElementById('stockMaximo');

function anadirUno() {
    let clickedButton = event.target;
            let parentDiv = clickedButton.closest('.top-card'); // Busca el div padre con la clase 'top-card'
            if(parentDiv == null){
                parentDiv = clickedButton.closest('.grid-productos');
            }
            let nombreProductoValue = parentDiv.querySelector('#nombreAddOne').value; // Obtiene el valor del input con id 'nombreAddOne' dentro del div padre
            let productoIDValue = parentDiv.querySelector('#idAddOne').value; // Obtiene el valor del input con id 'idAddOne' dentro del div padre
            let inputCantidadValue = 1;
            let diccionario = {
                [nombreProductoValue]: {
                    id: productoIDValue,
                    cantidad: inputCantidadValue
                }
            };
    let diccionarioJSON = JSON.stringify(diccionario);
    let carrito = new Carrito(diccionarioJSON);
    carrito.insertarUnProducto();
    //TO DO: Aqui ya se ha guardado el producto en la bdd, popup de confirmacion a continuacion
    //alert("Has añadido un producto al carrito!");
};

function anadirUnoNoLog(){
    let clickedButton = event.target;
    let parentDiv = clickedButton.closest('.top-card'); // Busca el div padre con la clase 'top-card'
    if(parentDiv == null){
        parentDiv = clickedButton.closest('.grid-productos');
    }
    let nombreProductoValue = parentDiv.querySelector('#nombreAddOne').value; // Obtiene el valor del input con id 'nombreAddOne' dentro del div padre
    let productoIDValue = parentDiv.querySelector('#idAddOne').value; // Obtiene el valor del input con id 'idAddOne' dentro del div padre
    let productoImgValue = parentDiv.querySelector('#imgAddOne').value;
    let productoPriceValue = parentDiv.querySelector('#priceAddOne').value;
    let inputCantidadValue = 1;
    let carrito = sessionStorage.getItem('carrito');
    carrito = carrito ? JSON.parse(carrito) : {};

    if (carrito.hasOwnProperty(nombreProductoValue)) {
        carrito[nombreProductoValue].cantidad += inputCantidadValue;
    } else {
        carrito[nombreProductoValue] = {
            nombre: nombreProductoValue,
            id: productoIDValue,
            cantidad: inputCantidadValue,
            imagen: productoImgValue,
            precio: productoPriceValue
        };
    }
    sessionStorage.setItem('carrito', JSON.stringify(carrito));
    //TO DO: Aqui ya se ha guardado el producto en el storage, popup de confirmacion a continuacion
    alert("Has añadido un producto al carrito!");

};
if(btnAddOne != null){
    btnAddOne.forEach(function(boton) {
        // Agrega un event listener para el evento de clic a cada botón
        boton.addEventListener('click', anadirUno);
    });
}

if (btnAddOneNoLog != null) {
    btnAddOneNoLog.forEach(function(boton){
        boton.addEventListener('click', anadirUnoNoLog) 
    });
}


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
if(btnAnadirCarrito != null){
    btnAnadirCarrito.addEventListener('click', function () {
        // Obtener los valores de los elementos
        let nombreProductoValue = nombreProducto.value;
        let inputCantidadValue = parseInt(inputCantidad.value);
        let productoIDValue = productoID.value;
        let diccionario = {
            [nombreProductoValue]: {
                id: productoIDValue,
                cantidad: inputCantidadValue
                
            }
        };
        let diccionarioJSON = JSON.stringify(diccionario);
        carrito = new Carrito(diccionarioJSON);
        carrito.insertarUnProducto();
        alert("Has añadido un producto al carrito!");
    });
    //TO DO: Aqui ya se ha guardado el producto en la bdd, popup de confirmacion a continuacion
}



if(btnAnadirCarritoNoLog != null){
    btnAnadirCarritoNoLog.addEventListener('click', function () {
         // Obtener los valores de los elementos
        let nombreProductoValue = nombreProducto.value;
        let inputCantidadValue = parseInt(inputCantidad.value);
        let productoIDValue = productoID.value;
        let productoImgValue = document.getElementById('productIMG').value;
        let productoPriceValue = document.getElementById('productPrice').value;
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
                nombre: nombreProductoValue,
                id: productoIDValue,
                cantidad: inputCantidadValue,
                imagen: productoImgValue,
                precio: productoPriceValue
            };
        }
        sessionStorage.setItem('carrito', JSON.stringify(carrito));
        //TO DO: Ya guardado en el sesion storage, aqui va el popup de confirmacion
        alert("Has añadido un producto al carrito!");
    });
}


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