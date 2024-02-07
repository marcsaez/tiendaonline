
<main id="principal-admin" class="dashboard">
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.0.0/fabric.min.js"></script>
  <div id="chartContainer" style="height: 370px; width: 100%;"></div>
  <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</main>


<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
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
    dataPoints: [
		
    <?php
        if (isset($datos)) {
            foreach ($datos as $dato) {
                $contador = $dato['y'];
                $nombreCategoria = $dato['label'];
                
                echo "{ y: $contador, label: '$nombreCategoria' },";
            }
        }
        ?> 
    ]
	}]
});
chart.render();

}
</script>