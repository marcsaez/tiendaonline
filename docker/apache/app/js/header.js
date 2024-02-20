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
    const finalizarCompraNoLog = document.getElementById('finalizar_compra_noLog');
    const popUpContainer = document.getElementById('popup-container');
    const desplegableUsuario = document.getElementById('desplegable-usuario');
    if(desplegableUsuario!=null){
        desplegableUsuario.style.display = 'none';
    }
    if(finalizarCompraNoLog!=null){
        finalizarCompraNoLog.addEventListener('click', function(){
            console.log("HOLA")
            if(!popUpContainer){
                desplegableUsuario.style.display = 'block';
            } else {
                popUpContainer.style.display = 'block';
            }
        });
    }
    userBtn.addEventListener('click', function(){
        if(!popUpContainer){
            desplegableUsuario.style.display = 'block';
        } else {
            popUpContainer.style.display = 'block';
        }
    });
    if(desplegableUsuario!=null){
        desplegableUsuario.addEventListener('mouseleave', () => {
            desplegableUsuario.style.display = 'none';
        });

    }

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

    
    document.getElementById('usuarioPassword').addEventListener('keyup', validarPassword);
    document.getElementById('usuarioPasswordRepeat').addEventListener('keyup', validarPassword);

});

function validarPassword(){
    const usuarioPassword = document.getElementById('usuarioPassword');
    const usuarioPasswordRepeat = document.getElementById('usuarioPasswordRepeat');

    if (usuarioPassword.value === usuarioPasswordRepeat.value) {
        usuarioPasswordRepeat.style.borderColor = 'green';
    } else {
        usuarioPasswordRepeat.style.borderColor = 'red';
    }
}

