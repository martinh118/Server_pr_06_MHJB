<?php
include_once("../model/modelo_sesion_iniciada.php");
include_once("../model/modelo_principal.php");
require_once("../vista/editar_articulo.php");

$errorArchivo = $_FILES['imagen']['error'];
$rutaTemporal = $_FILES['imagen']['tmp_name'];
$nombreArchivo = $_FILES['imagen']['name'];


if ($errorArchivo === UPLOAD_ERR_OK){

    if($_SESSION['imagenArticulo'] != '../src/claqueta_accion.png' ){
        unlink($_SESSION['imagenArticulo']);
    }

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
    $rutaCompletaArchivo = $_SESSION['imagenArticulo'];
    echo 'Imagen no detectada. <br>';
}

// Obté les dades de l'usuari al qual pertany l'article.
if (isset($_SESSION['usuario'])) {
    $user = $_SESSION["usuario"];
    $art = $_POST['content'];
    $tituloArt = $_POST['titulo'];
    $id = $_SESSION['idArt'];
   
}

//Edita l'article creat.
    editarArticulo($id, $tituloArt,trim($art), $rutaCompletaArchivo);
    echo "Articulo editado.";
