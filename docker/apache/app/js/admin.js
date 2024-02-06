<<<<<<< HEAD

=======
console.log("d")

document.addEventListener('DOMContentLoaded', function () {
    const anadirCategoriaContainer = document.getElementById('anadirCategoria');
    const btnMostrarCategoria = document.getElementById('btn-mostrarCategoria');
    
    btnMostrarCategoria.addEventListener('click', function (e) {
        e.stopPropagation(); // Evita que el clic se propague al documento
        anadirCategoriaContainer.style.display = 'block';
    });

    // Agrega un event listener al documento para cerrar el contenedor si se hace clic fuera de él
    document.addEventListener('click', function (e) {
        if (e.target !== anadirCategoriaContainer && !anadirCategoriaContainer.contains(e.target)) {
            anadirCategoriaContainer.style.display = 'none';
        }
    });

    const btnCategoriaEditar = document.querySelectorAll('.btn-categoria-editar');
    const editarCategoriaForm = document.getElementById('editar-categoria');
    const btnCancelar = document.getElementById('cancelar-edit-categoria');

    const inputNombre = document.getElementById('nombre');
    const inputCategoriaPadre = document.getElementById('categoriaPadre')

    btnCategoriaEditar.forEach(function(btn) {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            // Obtener la fila (tr) padre del botón clicado
            const fila = e.target.closest('tr');
            
            // Obtener los valores de las celdas en esa fila
            const idCategoria = fila.querySelector('td:nth-child(1)').innerText;
            const nombreCategoria = fila.querySelector('td:nth-child(2)').innerText;
            const categoriaPadre = fila.querySelector('td:nth-child(3)').innerText;

            const inputID = document.getElementById('id-editar');
            const inputNombre = document.getElementById('nombre-editar');
            const inputCategoriaPadre = document.getElementById('categoriaPadre-editar');

            inputNombre.setAttribute('value', nombreCategoria);
            inputCategoriaPadre.setAttribute('value', categoriaPadre);
            inputID.setAttribute('value', idCategoria);

            editarCategoriaForm.style.display = 'block';
        });
    });

    btnCancelar.addEventListener('click', function (){
        editarCategoriaForm.style.display = 'none';
    });
});
>>>>>>> 82546475aa67c575b050c280d8dd9356a6b5ac1c
