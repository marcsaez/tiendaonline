class Carrito {
    constructor(diccionario) {
        this.diccionario = diccionario;
    }

    ajaxCosas() {
        console.log(this.diccionario);
        var xhr = new XMLHttpRequest();
        // Configurar la solicitud POST a process.php
        xhr.open("POST", "indexAjax.php?controller=Carrito&action=getCarrito", true);
        // Configurar el encabezado para indicar que se está enviando un JSON
        xhr.setRequestHeader("Content-Type", "application/json");
        // Configurar la función de devolución de llamada cuando la solicitud esté completa
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    try {
                        var responseData = JSON.parse(xhr.responseText);
                        console.log(responseData);
                        console.log(xhr.responseText);
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
}

export default Carrito;
