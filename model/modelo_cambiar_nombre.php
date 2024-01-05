<?php
include_once("../model/modelo_principal.php");

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