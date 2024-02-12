<?php
require_once "models/usuario.php";
class UsuarioController{
    public function registrarUsuario(){
        $usuario = new usuario ($_POST['usuarioEmail'],$_POST['usuarioTelefono'],$_POST['usuarioNombre'],$_POST['usuarioApellido'],$_POST['usuarioDireccion'],$_POST['usuarioPassword']);
        $usuario->conectar();
        $registro=$usuario->registrarUsuario();
        if($registro == true){
            echo '<meta http-equiv="refresh" content="0;url=index.php">';
        }else{
            UsuarioController::registrarseAbrir();
            echo '<p>El correo ya esta en uso</p>';
        }
    }
    
    public function iniciarSesionUsuario(){
        $db = Usuario::staticConectar();
        $usuario=Usuario::iniciarSesion($db,$_POST['correoUsuario'], $_POST['passUsuario']);
        if($usuario==true){
            ?><script>
                let diccionario = sessionStorage.getItem('carrito');
                $.ajax({
                url: 'indexAjax.php?Controller=Carrito&action=obtenerDatosProductosCarrito',
                type: 'POST',
                contentType: 'application/json; charset=UTF-8',
                data: JSON.stringify({ carrito: diccionario}),
                success: function (data) {
                    console.log(data);
                    // Maneja la respuesta del servidor
                    if (data.success) {
                        console.log('Okay');
                        // console.log(data);
                    } else {
                        console.error('Error en la solicitud:', data.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    // Maneja el error
                    console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                    console.error('Estado de la respuesta:', xhr.status);
                    console.error('Respuesta del servidor:', xhr.responseText);
                }
            });
                sessionStorage.removeItem('carrito');
            </script>
            <?php
            echo '<meta http-equiv="refresh" content="0;url=index.php">';
        }elseif($usuario==false){
            echo '<meta http-equiv="refresh" content="0;url=index.php">';
        }
    }
    public function datosUser(){
        
    }

    public function iniciarSesionAbrir(){
        require_once "views/general/popup.php";
    }
    public function registrarseAbrir(){
        require_once "views/general/registrarUsuario.php";
    }
    public function logOutUsuario() {
        session_destroy();
        echo '<meta http-equiv="refresh" content="0;url=index.php">';
    }

    public function mostrarPerfil(){
        require "views/general/perfil.php";
    }
}

?>