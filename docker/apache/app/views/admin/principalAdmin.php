
<main id="principal-admin" class="dashboard">
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.0.0/fabric.min.js"></script>
  <div id="chartContainer" style="height: 370px; width: 100%;"></div>
  <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
  <script>
        // Incluir los datos JSON directamente en una variable JavaScript
        var datosJson = <?php echo json_encode($datos); ?>;
    </script>
</main>


<div id="Grafico1">
<script src="./js/canvasCirculo.js"></script>
</div>