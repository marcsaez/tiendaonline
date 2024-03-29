document.addEventListener('DOMContentLoaded', function () {
    var terminoInput = document.getElementById('busqueda');
    var resultadosDiv = document.getElementById('resultadosDiv');

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
        if(termino == ""){
            resultadosDiv.style.display = "none";
        } else{
            resultadosDiv.style.display = "block";
        fetch('indexAjax.php?Controller=Productos&action=buscarPrincipal', {
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
            //BucleEterno();
            mostrarResultados(data);
        })
        .catch(function (error) {
            console.error('Error en la solicitud Ajax:', error);
        })};
    
    }

    function mostrarResultados(resultados) {
        var html = '';
        
        for (var i = 0; i < resultados.length; i++) {
            html += '<div class="grid-busqueda">';
            html += '<div><img class="img-busqueda" src="' + resultados[i].productimg + '" alt="Imagen de ' + resultados[i].productname + '"></img></div>';
            html += '<div><a href="index.php?Controller=Productos&action=productoConcreto&productID=' + resultados[i].productid + '">';
            //html += '<p>' + resultados[i].productid + '</p>';
            html += '<p>' + resultados[i].productname + '</p>';
            html += '</a></div>';
            html += '<div><p>' + resultados[i].productprice + '€</p></div>';
            html += '</div>';
        }
        
        
        resultadosDiv.innerHTML = html;
    }
    // function BucleEterno(){
    //     var time;
    //     for (var i = 0; i < 10000; i++) {
    //         time = i;
    //       console.log(time)
    //     }
    //     console.log("Terminé");
    // }
});