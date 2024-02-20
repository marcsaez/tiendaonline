
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

        var chart = new CanvasJS.Chart("chartContainer1", {
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

