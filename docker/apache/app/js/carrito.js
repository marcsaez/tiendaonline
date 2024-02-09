class Carrito {
    constructor(diccionario) {
        this.diccionario = diccionario;
    }
        ajaxCosas() {
            console.log(this.diccionario);
            $.ajax({
                url: 'indexAjax.php?Controller=Carrito&action=obtenerDatosProductosCarrito',
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
        insertarUnProducto(){
            console.log(this.diccionario);
            $.ajax({
                url: 'indexAjax.php?Controller=Carrito&action=obtenerDatosProductosCarritoDos',
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