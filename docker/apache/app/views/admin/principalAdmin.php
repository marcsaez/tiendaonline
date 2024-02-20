
<main id="principal-admin" class="dashboard">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.0.0/fabric.min.js"></script>
  <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
  
  <div class="admin-content">
    <section class="admin-headers">
      <h1>Estadísticas</h1>
    </section>
    <div id="chartContainer" style="height: 370px; width: 50%;"></div>
  </div>
  <script>
    // Incluir los datos JSON directamente en una variable JavaScript
    var datosJson = <?php echo json_encode($datos); ?>;
    var datosJson1 = <?php echo json_encode($datos1); ?>;
  </script>
  <div id="Grafico1">
    <script src="./js/canvasCirculo.js"></script>
    <script src="./js/canvasStock.js"></script>
  </div>
</main>

