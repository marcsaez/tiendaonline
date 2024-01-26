class Producto {
    constructor(id, nombre, cantidad, precioTotal) {
        this.id = id;
        this.nombre = nombre;
        this.cantidad = cantidad;
        this.precioTotal = precioTotal;
    }
    calcularPrecio(){
        const precioUnitarioElement = document.getElementById('precioProducto');
        const cantidadElement = document.getElementById('cantidad');
        const precioUnitario = parseFloat(precioUnitarioElement.value);
        const cantidad = parseInt(cantidadElement.value);
        const precioTotal = precioUnitario * cantidad;
        return precioTotal;
    }
    anadirProductoCarrito(product){
            let requestData = {
                id: product.id,
                nombre: product.nombre,
                cantidad: product.cantidad,
                precioTotal: product.precioTotal
            };
   
        
        // Crear una instancia de XMLHttpRequest
        var xhr = new XMLHttpRequest();

        // Configurar la solicitud POST a process.php
        xhr.open("POST", "./controllers/CarritoController.php", true);

        // Configurar el encabezado para indicar que se está enviando un JSON
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Configurar la función de devolución de llamada cuando la solicitud esté completa
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    try {
                        var responseData = JSON.parse(xhr.responseText);
                        console.log(responseData);
                    } catch (error) {
                        console.error("Error al analizar la respuesta JSON: " + error.message);
                    }
                } else {
                    // Manejar errores si la solicitud no fue exitosa
                    console.error("Error en la solicitud: " + xhr.status);
                }
            }
        };
        // Convertir los datos a JSON y enviar la solicitud
        xhr.send("data=" + encodeURIComponent(JSON.stringify(requestData)));
    }
}
export default Producto;