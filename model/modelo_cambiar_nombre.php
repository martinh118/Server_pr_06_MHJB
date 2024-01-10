<?php
include_once("../model/modelo_principal.php");
/**
 * @author Martín Hernan Jaime Bonvin
 * @version 4.0
 */
/**
 * 
 * Canvia el nom d'usuari a la base de dades.
 * @param usuario: Nom de l'usuari que realitza el canvi.
 * @param nuevoNombre: Nou nom a canviar.
 * 
 */
function cambiarNombre($usuario, $nuevoNombre){
    try {
        $connexio = conectar();
        $statement = $connexio->prepare('UPDATE users SET nom_usuari = :nuevoNombre WHERE nom_usuari = :usuario');
        $statement->execute(
            array(
                ':usuario' =>$usuario,
                ':nuevoNombre' => $nuevoNombre
            )
        );
    } catch (PDOException $e) { //
        // mostrarem els errors
        echo "Error: " . $e->getMessage();
    }
}