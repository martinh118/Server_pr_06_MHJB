<?php 

include_once("modelo_principal.php");
/**
 * @author Martín Hernan Jaime Bonvin
 * @version 4.0
 */
/**
 * Canvia el token a la base de dades
 * @param token: nou token
 * @param email: email de l'usuari.
 * 
*/
function cambiarToken($token, $email){
    try {
        $connexio = conectar();
        $statement = $connexio->prepare('UPDATE users SET token = :token WHERE email_usuari = :email');
        $statement->execute(
            array(
                ':token' => $token,
                ':email' => $email
            )
        );
        
    } catch (PDOException $e) { //
        // mostrarem els errors
        echo "Error: " . $e->getMessage();
    }
}

/**
 * canvia la contrasenya de l'usuari
 * @param email: email de l'usuari
 * @param contra: nova contrasenya
 */
function cambioContraseña($email, $contra){
    try {
        $connexio = conectar();
        $statement = $connexio->prepare('UPDATE users SET contra = :contra WHERE email_usuari = :email');
        $statement->execute(
            array(
                ':contra' => $contra,
                ':email' => $email
            )
        );
        
    } catch (PDOException $e) { //
        // mostrarem els errors
        echo "Error: " . $e->getMessage();
    }
}

/**
 * canvia la contrasenya de l'usuari
 * @param nombre: nombre de l'usuari
 * @param contra: nova contrasenya
 */
function cambioContraseñaUsuario($nombre, $contra){
    try {
        $connexio = conectar();
        $statement = $connexio->prepare('UPDATE users SET contra = :contra WHERE nom_usuari = :nombre');
        $statement->execute(
            array(
                ':contra' => $contra,
                ':nombre' => $nombre
            )
        );
        
    } catch (PDOException $e) { //
        // mostrarem els errors
        echo "Error: " . $e->getMessage();
    }
}