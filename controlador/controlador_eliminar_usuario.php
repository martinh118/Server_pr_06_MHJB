<?php 
/**
 * @author Martín Hernan Jaime Bonvin
 * @version 4.0
 */
include_once("../model/modelo_eliminar_usuario.php");

/**
 * Elimina l'usuari a la base de dades i redirecciona la página a l'inici.
 */
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