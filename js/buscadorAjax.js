document.addEventListener('DOMContentLoaded', function () {
    var terminoInput = document.getElementById('termino');
    var resultadosDiv = document.getElementById('resultadosDivAdmin');

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
        html += '<th>ID</th>';
        html += '<th>Foto</th>';
        html += '<th>Nombre</th>';
        html += '<th>Categoria</th>';
        html += '<th>Stock</th>';
        html += '<th>Precio</th>';
        html += '<th>Destacado</th>';
        html += '<th>Activo</th>';
        html += '<th>Editar</th>';
        html += '<th>Eliminar</th>';
        html += '</tr>';
        for (var i = 0; i < resultados.length; i++) {
            html += '<tr>';
            html += '<td>' + resultados[i].productid + '</td>';
            html += '<td><img src="' + resultados[i].productimg + '" alt="Imagen de ' + resultados[i].productname + '"></td>';
            html += '<td>' + resultados[i].productname + '</td>';
            html += '<td>' + resultados[i].fkcategories + '</td>';   
            html += '<td>' + resultados[i].productstock + '</td>';
            html += '<td>' + resultados[i].productprice + '</td>';
            html += '<td>' + resultados[i].productnoted + '</td>';
            html += resultados[i].destacado_html;
            html += resultados[i].activo_html;
            html += resultados[i].editar_html;
            html += '</tr>';
        }
        resultadosDiv.innerHTML = html;
    }
});
