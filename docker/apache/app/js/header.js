function mostrarDesplegable() {
    var desplegable = document.getElementById("desplegable");
    if (desplegable.style.display === "none" || desplegable.style.display === "") {
        desplegable.style.display = "block";
    } else {
        desplegable.style.display = "none";
    }
}
function mostrarMenu() {
    var desplegable = document.getElementById("desplegableMenu");
    if (desplegable.style.display === "none" || desplegable.style.display === "") {
        desplegable.style.display = "block";
    } else {er
        desplegable.style.display = "none";
    }
}

document.addEventListener('DOMContentLoaded', function(){
    const userBtn = document.getElementById('user-btn');
    const popUpContainer = document.getElementById('popup-container');
    
    userBtn.addEventListener('click', function(){
        popUpContainer.style.display = 'block';
    });

    popUpContainer.addEventListener('click', function(event){
        if(event.target === popUpContainer){
            popUpContainer.style.display = 'none';
        }
    });

    // Agregar evento de scroll
    window.addEventListener('scroll', function () {
        // Determinar la posición de desplazamiento actual
        const scrollPosition = window.scrollY;
        console.log(scrollPosition)
        // Verificar si el usuario se ha desplazado hacia abajo más de X píxeles
        const scrollThreshold = 100; // Puedes ajustar este valor según tus necesidades
        const header = document.getElementById('header');

        if (scrollPosition > scrollThreshold) {
            // El usuario se ha desplazado hacia abajo más de X píxeles
            console.log('Usuario se desplazó hacia abajo');
            // Puedes realizar acciones adicionales aquí
            header.style.position = 'fixed';
            
        }else {
            header.style.position = 'relative';
        }
    });
});
