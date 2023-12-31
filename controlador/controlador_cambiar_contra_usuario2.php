<?php
include_once("../vista/cambiar_contraseña_usuario.php");
include_once("../model/modelo_contraseña.php");
include_once("../model/modelo_registro.php");

session_start();
function cambiarContra(){
    
    $error = "";
    $error .= comprobarContraActual();
    $error .= comprobarContraseñasNuevas();
    $error .= comprobarActualNueva();
    if ($error == "") {
        $nuevaContra = password_hash($_POST['contraNueva'], PASSWORD_DEFAULT);
        cambioContraseñaUsuario($_SESSION['usuario'], $nuevaContra);
        echo 'Contrasenya canviada';
    } else echo $error;
}


function comprobarContraActual()
{
    $nom = $_SESSION['usuario'];
    $user = selectUsuario($nom)->fetch();
    $contraseñaActual = $_POST['contraActual'];

    return password_verify($contraseñaActual, $user['contra']) ? "" : "Error al comprovar contraseyta actual<br>";
}

function comprobarActualNueva()
{
    $contraActual = $_POST['contraActual'];
    $contraNueva = $_POST['contraNueva'];
    if($contraActual == $contraNueva){
        return "La contrasenya nova no pot ser la mateix que l'actual.<br>";
    }else return "";
}

/**
 * Fa les correctes comprovacions per verificar la contrasenya nova.
 * @return String: En cas de que hi hagi un error, retorna el missatge d'aquest. En cas contrari retorna un string buit.  
 */
function comprobarContraseñasNuevas()
{
    $nuevaContra = password_hash($_POST['contraNueva'], PASSWORD_DEFAULT);
    $reNuevaContra = $_POST['reContraNueva'];

    if ($_POST['contraNueva'] != null && $_POST['reContraNueva'] != null) {
        if (password_verify($reNuevaContra, $nuevaContra)) {
            return "";
        } else return "Las nuevas contraseñas NO coinciden<br>";
    } else return "Los campos no pueden estar vacios<br>";
}

cambiarContra();