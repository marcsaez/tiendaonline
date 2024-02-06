document.addEventListener('DOMContentLoaded', function () {
    var terminoInput = document.getElementById('termino');
    var resultadosDiv = document.getElementById('resultadosDivAdmin');

    terminoInput.addEventListener('input', function () {
        var termino = terminoInput.value.trim();
        realizarBusqueda(termino);
    });

    terminoInput.addEventListener('keypress', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Evitar la acción predeterminada (como enviar el formulario)

            var termino = terminoInput.value.trim();
            realizarBusqueda(termino);
        }
        
    });

    function realizarBusqueda(termino) {
        console.log('Término de búsqueda:', termino);

        // Puedes utilizar URLSearchParams para construir los datos de formulario
        var data = new URLSearchParams();
        data.append('termino', termino);

        fetch('indexAjax.php?Controller=Categorias&action=buscar', {
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
        var html =''; 
        html += '<tr>';
        html += '<th>ID</th>';
        html += '<th>Nombre</th>';
        html += '<th>Categoría Padre</th>';
        html += '<th>Editar</th>';
        html += '<th>Eliminar</th>';
        html += '</tr>';
        for (var i = 0; i < resultados.length; i++) {
            html += '<tr>';
            html += '<td>' + resultados[i].categoryid + '</td>';
            html += '<td>' + resultados[i].categoryname + '</td>';
            var $padre = (resultados[i].fkfathercategory == null) ? "Sin Categoría" : resultados[i].fkfathercategory;
            html += '<td>' + $padre +'</td>';
            html += '<td><a class="editar"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>Editar</a></td>';
            html += ' <td><a class="eliminar" href="index.php?Controller=Categorias&action=eliminar&IDCategoria='+resultados[i].categoryid+'"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>Eliminar</a></td>';
            html += '</tr>';
        }
        resultadosDiv.innerHTML = html;
    }
});