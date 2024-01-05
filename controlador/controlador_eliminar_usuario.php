<?php 
include_once("../model/modelo_eliminar_usuario.php");

function eliminarUsuario()
{
    session_start();
    $nombreUsuario = $_SESSION['usuario'];
    deleteUser($nombreUsuario);
    $script = <<<EOT
                <script type='text/javascript'>
                window.location.replace("../vista/index.vista.php");
                alert('Usuari eliminat.');
                </script>
                EOT;
    echo $script;
}

eliminarUsuario();