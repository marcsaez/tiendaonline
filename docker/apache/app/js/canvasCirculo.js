document.addEventListener("DOMContentLoaded", function() {
    // Utilizar los datos para renderizar el primer gráfico
    renderizarGrafico1(datosJson);

    // Función para renderizar el primer gráfico con los datos obtenidos
    function renderizarGrafico1(datos) {
        var dataPoints = [];
        console.log(datos);
        
        if (datos) {
            for (var i = 0; i < datos.length; i++) {
                var contador = datos[i]['y'];
                var nombreCategoria = datos[i]['label'];
                dataPoints.push({ y: contador, label: nombreCategoria });
            }
        }

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: "Productos por categoría",
                horizontalAlign: "left"
            },
            data: [{
                type: "doughnut",
                startAngle: 60,
                //innerRadius: 60,
                indexLabelFontSize: 17,
                indexLabel: "{label} - #percent%",
                toolTipContent: "<b>{label}:</b> {y} (#percent%)",
                dataPoints: dataPoints
            }]
        });

        chart.options.backgroundColor = "#575757";

        chart.render();
    }
});
