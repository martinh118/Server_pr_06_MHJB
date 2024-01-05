<?php
include_once("../vista/cambiar_nombre.php");
include_once("../model/modelo_cambiar_nombre.php");

session_start();
$nombreUsuario = $_SESSION['usuario'];
$nuevoNombre = $_POST['nuevoNombre'];


cambiarNombre($nombreUsuario, $nuevoNombre);
echo 'Nom d\'usuari canviat';
$_SESSION['usuario'] = $nuevoNombre;
