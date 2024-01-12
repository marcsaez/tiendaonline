document.addEventListener('DOMContentLoaded', function () {
    var terminoInput = document.getElementById('busqueda');
    var resultadosDiv = document.getElementById('resultadosDiv');

    terminoInput.addEventListener('keyup', function () {
       
            var termino = terminoInput.value;
            realizarBusqueda(termino);
        
    });

    function realizarBusqueda(termino) {
        console.log('Término de búsqueda:', termino);

        // Puedes utilizar URLSearchParams para construir los datos de formulario
        var data = new URLSearchParams();
        data.append('termino', termino);

        fetch('indexAjax.php?Controller=Productos&action=buscar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: data,
        })
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            console.log("Esto es el data: ", data);
            mostrarResultados(data);
        })
        .catch(function (error) {
            console.error('Error en la solicitud Ajax:', error);
        });
    }

    function mostrarResultados(resultados) {
        var html = '';
        
        for (var i = 0; i < resultados.length; i++) {
            html += '<a href= "index.php?Controller=Productos&action=productoConcreto&productID='+ resultados[i].productid+'"><p>'+ resultados[i].productid + ' - ' + resultados[i].productname + ' - ' + resultados[i].productdescription + ' - ' + resultados[i].productprice + ' - ' +  resultados[i].productid + '</p></a>';
        }

        resultadosDiv.innerHTML = html;
    }
});