<?php
/**
 * @author Martín Hernan Jaime Bonvin
 * @version 4.0
 */
include_once("../vista/cambiar_contraseña_usuario.php");
include_once("../model/modelo_contraseña.php");
include_once("../model/modelo_registro.php");

session_start();
/**
 * Realitza les comprovacions bàsiques perquè la contrasenya actual sigui la correcta, i que els dos camps de la nova contrasenya siguin la mateixa.
 * Si tot és correcte, fa el canvi a la base de dades.
 */
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

/**
 * Fa la comprovació per veure si la contrasenya actual sigui el correcte.
 * @return error: Retorna el missatge d'error.
 */
function comprobarContraActual()
{
    $nom = $_SESSION['usuario'];
    $user = selectUsuario($nom)->fetch();
    $contraseñaActual = $_POST['contraActual'];

    return password_verify($contraseñaActual, $user['contra']) ? "" : "Error al comprovar contraseyta actual<br>";
}


/**
 * Comprova que la contrasenya actual i la nova no sigui la mateixa.
 * @return error: Retorna el missatge d'error.
 */
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