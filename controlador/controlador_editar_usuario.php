<?php
/**
 * @author Martín Hernan Jaime Bonvin
 * @version 4.0
 */
include_once("../vista/editar_usuari.php");

/**
 * Si es detecta el nom d'un usuari mostra aquest.
 */
function mostrarNombre()
{
    session_start();
    if (isset($_SESSION['usuario'])) {
        $content = $_SESSION["usuario"];
        echo $content;
    }
}




