class Carrito {
    constructor(diccionario) {
        this.diccionario = diccionario;
    }
    ajaxCosas() {
        console.log(this.diccionario);
        var xhr = new XMLHttpRequest();
        // Configurar la solicitud POST a process.php
        xhr.open("POST", "index.php?Controller=Carrito&action=obtenerDatosProductosCarrito", true);
        // Configurar el encabezado para indicar que se está enviando un JSON
        xhr.setRequestHeader("Content-Type", "application/json");
        // Configurar la función de devolución de llamada cuando la solicitud esté completa
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    try {
                        var responseData = JSON.parse(xhr.responseText); // Aquí se utiliza xhr.responseText
                        console.log(responseData);
                    } catch (error) {
                        console.error("Error al analizar la respuesta JSON: " + error.message);
                        console.log(xhr.responseText);
                    }
                } else {
                    // Manejar errores si la solicitud no fue exitosa
                    console.error("Error en la solicitud: " + xhr.status);
                    console.log(xhr.responseText);
                }
            }
        };
        // Convertir los datos a JSON y enviar la solicitud
        xhr.send(JSON.stringify(this.diccionario));
    }
    guardarCarritoEnPHP() {
        // Obtén el contenido de sessionStorage
        var carrito = sessionStorage.getItem('carrito');
        // Verifica si hay algo en el carrito
        if (carrito) {
            // Realiza una solicitud AJAX para enviar el carrito a PHP
            var xhr = new XMLHttpRequest();
            xhr.open('POST', './controllers/CarritoController.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // La respuesta del servidor (puede ser útil manejarla de alguna manera)
                    console.log(xhr.responseText);
                }
            };
            // Envía el carrito al servidor PHP
            xhr.send('carrito=' + carrito);
        } else {
            console.log('El carrito está vacío.');
        }
    }
    
}

export default Carrito;
