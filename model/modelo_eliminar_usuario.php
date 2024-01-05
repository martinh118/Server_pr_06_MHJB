<?php
include_once("../model/modelo_principal.php");

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
