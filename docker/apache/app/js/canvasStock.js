document.addEventListener("DOMContentLoaded", function() {
    renderizarGrafico(datosJson1);

    function renderizarGrafico(datos) {
        var dataPoints = [];
            
        if (datos) {
            console.log(datos);
            for (var i = 0; i < datos.length; i++) {
                var contador = datos[i]['y'];
                var nombreCategoria = datos[i]['indexLabel'];
                dataPoints.push({ y: contador, label: nombreCategoria });
            }
        }

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            title: {
                text: "Stock por categorias"
            },
            data: [{
                type: "pyramid",
                indexLabelFontSize: 18,
                valueRepresents: "area",
                showInLegend: true,
                legendText: "{indexLabel}",
                toolTipContent: "<b>{indexLabel}</b> {y} productos",
                dataPoints: dataPoints
            }]
        });
        
        chart.options.backgroundColor = "#575757";
        chart.render();
    }
});
