<?php 
function mostrarNombre()
{
    session_start();
    if (isset($_SESSION['usuario'])) {
        $content = $_SESSION["usuario"];
        echo $content;
    }
}

