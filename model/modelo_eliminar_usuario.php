<?php
include_once("../model/modelo_principal.php");
/**
 * @author Martín Hernan Jaime Bonvin
 * @version 4.0
 */
/**
 * Esborra l'usuari de la base de dades.
 * @param usuario: Nom de l'usuari que vol eliminar el compte.
 */
function deleteUser($usuario)
{
    try {
        $connexio = conectar();
        $statement = $connexio->prepare('DELETE FROM users WHERE nom_usuari = :usuario');
        $statement->execute(
            array(
                ':usuario' => $usuario
            )
        );
        reordenarUsuarios();
    } catch (PDOException $e) { //
        // mostrarem els errors
        echo "Error: " . $e->getMessage();
    }
}

/**
 * Reordena l'identificador de tots els usuaris per que siguin un ordre.
 */
function reordenarUsuarios()
{
    try {
        $connexio = conectar();
        $statement = $connexio->prepare("ALTER TABLE users DROP ID");
        $statement->execute();
        $statement = $connexio->prepare("ALTER TABLE users AUTO_INCREMENT = 1");
        $statement->execute();
        $statement = $connexio->prepare("ALTER TABLE users ADD ID int NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST");
        $statement->execute();
    } catch (PDOException $e) { //
        // mostrarem els errors
        echo "Error: " . $e->getMessage();
    }
}
