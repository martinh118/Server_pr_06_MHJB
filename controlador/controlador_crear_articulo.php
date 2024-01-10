<?php
/**
 * @author Martín Hernan Jaime Bonvin
 * @version 4.0
 */
include_once("../model/modelo_sesion_iniciada.php");
include_once("../model/modelo_principal.php");
require_once("../vista/crear_articulo.php");

// Inicia la session
session_start();
    if (isset($_SESSION['usuario'])){
        $user = $_SESSION["usuario"];
        
}

$errorArchivo = $_FILES['imagen']['error'];
$rutaTemporal = $_FILES['imagen']['tmp_name'];
$nombreArchivo = $_FILES['imagen']['name'];

if ($errorArchivo === UPLOAD_ERR_OK){

    $directorioDestino = '../src/';
    // Generar un nombre único para evitar posibles conflictos
    $nombreArchivoFinal = uniqid('imagen_') . '_' . $nombreArchivo;

    // Mover el archivo a la ubicación deseada
    move_uploaded_file($rutaTemporal, $directorioDestino . $nombreArchivoFinal);

    // Ahora, $nombreArchivoFinal contiene el nombre único de la imagen en tu sistema de archivos

    
$rutaCompletaArchivo = $directorioDestino . $nombreArchivoFinal;
// Realizar la inserción en la base de datos con $rutaCompletaArchivo
} else {
    // Manejar errores en la carga del archivo
    $rutaCompletaArchivo = "../src/claqueta_accion.png";
    echo 'Imagen no detectada. <br>';
}


//Selecciona tots els articles registrats a la base de dades per obtenir el següent numero d'identificació del nou article.
$articulos = seleccionarArticulos()->fetchAll();
$num = count($articulos) + 1;

// Crea l'article.
crearArticuloUsuario($num,$_POST['titulo'] ,$_POST['content'], $user, $rutaCompletaArchivo);
echo "Articulo creado.";
