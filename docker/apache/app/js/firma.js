document.addEventListener('DOMContentLoaded', function(){

    var canvas = document.getElementById('lienzo');
    var ctx = canvas.getContext('2d');
    
    var mouseX, mouseY;
    var dibujando = false;
    var modoBorrar = false;
    
    ctx.lineWidth = 2;
    ctx.strokeStyle = 'black';
    
    canvas.addEventListener('mousedown', function(e) {
      dibujando = true;
      mouseX = e.pageX - canvas.offsetLeft;
      mouseY = e.pageY - canvas.offsetTop;
    });
    
    canvas.addEventListener('mouseup', function() {
      dibujando = false;
      ctx.beginPath();
    });
    
    canvas.addEventListener('mousemove', function(e) {
      if (!dibujando) return;
    
      var mouseXNuevo = e.pageX - canvas.offsetLeft;
      var mouseYNuevo = e.pageY - canvas.offsetTop;
    
      if (!modoBorrar) {
        ctx.beginPath();
        ctx.moveTo(mouseX, mouseY);
        ctx.lineTo(mouseXNuevo, mouseYNuevo);
        ctx.stroke();
      } else {
        // Utiliza el color del fondo para "borrar" dibujando sobre el trazo con un rectángulo blanco
        ctx.clearRect(mouseXNuevo - 10, mouseYNuevo - 10, 20, 20);
      }
    
      mouseX = mouseXNuevo;
      mouseY = mouseYNuevo;
    });
    
    // Toggle entre borrar y escribir al hacer clic en el botón
    const textToggleBtn = document.getElementById('btn-canvas-toggle');
    const iconoDibujar = document.getElementById('icon-dibujar');
    const iconoBorrar = document.getElementById('icon-borrar');
    var toggleBtn = document.getElementById('toggleBtn');
    toggleBtn.addEventListener('click', function() {
        modoBorrar = !modoBorrar;
        if (!modoBorrar) {
            textToggleBtn.textContent = 'Modo Dibujar';
            iconoDibujar.style.display = 'block';
            iconoBorrar.style.display = 'none';
        } else {
            iconoDibujar.style.display = 'none';
            iconoBorrar.style.display = 'block';
            textToggleBtn.textContent = 'Modo Borrar';
        }
    });
    
    var guardarBtn = document.getElementById('guardarBtn');
    guardarBtn.addEventListener('click', function() {
      var dataURL = canvas.toDataURL(); // No es necesario especificar 'img/firmas'
      
      // Enviar la imagen al servidor
      var xhr = new XMLHttpRequest();
      xhr.open('POST', './views/admin/guardar_imagen_canvas.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          console.log(xhr.responseText);
        }
      };
    
      xhr.send('imagen=' + encodeURIComponent(dataURL));
    });
});
