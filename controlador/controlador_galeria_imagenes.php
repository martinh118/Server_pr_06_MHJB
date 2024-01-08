<?php
include_once("../vista/galeria_imagenes.php");
include_once("../model/modelo_principal.php");



function opcionesHeader()
{
    session_start();
    $header = "<h2>Pt_06_Martín_Jaime</h2>";
    if (isset($_GET['nom'])) {
        $_SESSION['usuario'] = $_GET['nom'];
        $header .= "<h3>" . $_SESSION['usuario'] . "</h3>
        <a href='../vista/sesion_iniciada.php'>INICI</a>
		<a href='../vista/galeria_imagenes.php'>GALERIA D'IMATGES</a>
		<a href='../vista/editar_usuari.php?nom=<?php echo" . $_SESSION['usuario'] . " ?>'>EDITAR USUARI</a>
		<a href='../vista/index.vista.php'>TANCAR SESSIÓ</a>";
    } else {
        $header .= "<a href='../vista/index.vista.php'>INICI</a>;
        <a href='../vista/galeria_imagenes.php'>GALERIA D'IMATGES</a>
		<a href='../vista/inicio_sesion.php'>INICIAR SESSION</a>
		<a href='../vista/registro.php'>REGISTRAR-SE</a>";
    }
    echo $header;
}

function mostrarImagenes()
{
    edicion();
    $codigoImagenes = "";
    if (isset($_GET['nom'])) {
        include_once("../model/modelo_sesion_iniciada.php");
        $articulos = seleccionarArticulosUsuario($_GET['nom'])->fetchAll();
        $total_paginas = ceil(count($articulos) / 5);
        $pagina = paginas($total_paginas);

        mostrarArtsUsers($articulos, $pagina);
        crearPaginacion($total_paginas, $pagina);
    } else {

        $cantidadPagina = 5;
        $quant = seleccionarArticulos()->fetchAll();
        $total_paginas = ceil(count($quant) / $cantidadPagina);
        $pagina = paginas($total_paginas);

        mostrarArts($total_paginas, $pagina);
        crearPaginacion($total_paginas, $pagina);
    }
    echo $codigoImagenes;
}


/**
 * Fa la comprovació de a quina pàgina es truca.
 * @param total_paginas: pàgina seleccionada
 * @return pagina: numero de pàgina
 */
function paginas($total_paginas)
{
    if (empty($_GET["pagina"]) || $_GET["pagina"] >  $total_paginas || $_GET["pagina"] <  1) {
        $pagina = 1;
    } else {
        $pagina = $_GET["pagina"];
    }

    return $pagina;
}

/**
 * A partir de la columna d'articles amb el nom de l'usuari actual, es mostraran els articles que té habilitats.
 * A més, afegeix les opcions d'eliminar i editar a cada article.
 * @param arts: Connexió a la Base de dades.
 * @param pag: Quantitat d'articles mostrats per pàgina.

 */
function mostrarArtsUsers($arts, $pag)
{
    try {

        $articulos = $arts;
        $articulosInput = "";
        if (empty($articulos)) {
            $articulosInput = "<br>No hi ha articles disponibles.";
        } else {

            $pag = $_GET['pagina'];
            $articulosInput = "<section class='articles'><ul>";


            foreach ($articulos as $a) {

                if ($a['autor'] == $_SESSION['usuario']) {
                    $articulosInput .= "<ul  > <div style='text-align: center;'>";
                    $articulosInput .= '<img class="imgArticle" src="' . $a['rutaImagen'] . '" alt="Imagen" ><div><br>';
                    $articulosInput .= "&nbsp&nbsp<button id='borrar'><a  href='../controlador/controlador_galeria_imagenes.php?pagina=" . $pag . "&id= " . $a['ID'] . "&edit=" . "borrar" . "&nom=".$_SESSION['usuario']."'>Borrar</a></button> &nbsp&nbsp";
                    $articulosInput .= "<button><a href='../vista/editar_articulo.php?id= " . $a['ID'] . "&nom=".$_SESSION['usuario']."'>Editar</a></button></ul>";
                    
                    /*
                    $articulosInput .= "<li><strong> " . $a['ID'] . '.- <img src="' . $a['rutaImagen'] . '" alt="Imagen" style="max-width: 50px;"> ' ; 
                    $articulosInput .= "</strong> ". htmlspecialchars($a['article']) . "  <strong>" . $a['autor'] . " </strong>";
                    
                    $articulosInput .= "</li>";
                    */
                }
            }
            $articulosInput .= "</ul></section>";
        }
        echo $articulosInput;
    } catch (PDOException $e) { //
        // mostrarem els errors
        echo "Error: " . $e->getMessage();
    }
}

/**
 * Mostra tots els articles publics i dels usuaris que no sigui l'actual.
 * @param CANTIDAD: Quantitat d'articles mostrats per pàgina.
 * @param pag: Número de la pàgina seleccionat.
 */
function mostrarArts($CANTIDAD, $pag)
{
    try {
        $INICIO = ($CANTIDAD * $pag) - $CANTIDAD;
        $FINAL = $CANTIDAD * $pag;

        $articulos = seleccionarRangoArt($INICIO, $FINAL)->fetchAll();
        $articulosInput = "";
        if (empty($articulos)) {
            $articulosInput = "<br>No hay articulos disponibles";
        } else {

            if (isset($_GET['pagina'])) {
                $pag = $_GET['pagina'];
            } else $pag = 1;

            $articulosInput = "<div class='articles'>";

            foreach ($articulos as $a) {

                if ($a['autor'] != $_SESSION['usuario']) {
                    if ($a['rutaImagen'] != null) {
                        $articulosInput .= "<ul> <div style='text-align: center;'>";
                        $articulosInput .= '<img class="imgArticle" src="' . $a['rutaImagen'] . '" alt="Imagen" ><br><br><div></ul>';
                       
                    } else {
                        $articulosInput .= "<li><strong>" . $a['ID'] . ".- </strong>" . $a['article'] . " ( <strong>" . $a['autor'] . "</strong> )";
                        $articulosInput .= "</li>";
                    }
                }
            }
            $articulosInput .= "</div>";
        }
        echo $articulosInput;
    } catch (PDOException $e) { //
        // mostrarem els errors
        echo "Error: " . $e->getMessage();
    }
}


/**
 * Crea la paginació mostrada a la pantalla, on en les fletxes situades als extrems tindrà una classe que els desactivarà depenent si l'usuari es troba a la primera pàgina, o a l'última.
 * En cas que l'usuari es trobi a la pàgina número u, la fletxa esquerra es trobarà desactivada. De la mateixa manera amb el de la dreta amb l'última pàgina.
 * @param paginas: Valor on es troba el nombre de pàgines que existeixen depenent de quants articles hi hagi a la BDD.
 * @param numPagina: Número de la pàgina on es troba actualment l'usuari. 
 * 
 */
function crearPaginacion($paginas, $numPagina)
{

    try {
        $paginacionInput = "";
        if (isset($_GET['nom'])) {
            $retro = $numPagina - 1;
            $avan = $numPagina + 1;
            if ($numPagina == 1) {
                $paginacionInput = "<div><section class='paginacio'><ul><li ><a data-disabled='true' class='disabled-link' href='../controlador/controlador_galeria_imagenes.php?pagina=" . $retro  . "&nom=".$_SESSION['usuario']."'>&laquo;</a></li>";
            } else $paginacionInput = "<div><section class='paginacio'><ul><li ><a href='../controlador/controlador_galeria_imagenes.php?pagina=" . $retro  . "&nom=".$_SESSION['usuario']."'>&laquo;</a></li>";

            for ($i = 1; $i <= $paginas; $i++) {
                if ($numPagina == $i) {
                    $paginacionInput .= "<li class='active'><a href='../controlador/controlador_galeria_imagenes.php?pagina=" . $i  . "&nom=".$_SESSION['usuario']."' >" . $i . "</a></li>";
                } else $paginacionInput .= "<li><a href='../controlador/controlador_galeria_imagenes.php?pagina=" . $i  . "&nom=".$_SESSION['usuario']."' >" . $i . "</a></li>";
            }

            if ($numPagina == $paginas) {
                $paginacionInput .= "<li data-disabled='true' class='disabled-link'><a href='../controlador/controlador_galeria_imagenes.php?pagina=" . $avan  . "&nom=".$_SESSION['usuario']."'>&raquo;</a></li></ul></section></div>";
            } else $paginacionInput .= "<li><a href='../controlador/controlador_galeria_imagenes.php?pagina=" . $avan  . "&nom=".$_SESSION['usuario']."'>&raquo;</a></li></ul></section></div>";
        
        } else {
            $retro = $numPagina - 1;
            $avan = $numPagina + 1;
            if ($numPagina == 1) {
                $paginacionInput = "<div><section class='paginacio'><ul><li ><a data-disabled='true' class='disabled-link' href='../controlador/controlador_galeria_imagenes.php?pagina=" . $retro  . "'>&laquo;</a></li>";
            } else $paginacionInput = "<div><section class='paginacio'><ul><li ><a href='../controlador/controlador_galeria_imagenes.php?pagina=" . $retro  . "'>&laquo;</a></li>";


            for ($i = 1; $i <= $paginas; $i++) {
                if ($numPagina == $i) {
                    $paginacionInput .= "<li class='active'><a href='../controlador/controlador_galeria_imagenes.php?pagina=" . $i  . "' >" . $i . "</a></li>";
                } else $paginacionInput .= "<li><a href='../controlador/controlador_galeria_imagenes.php?pagina=" . $i  . "' >" . $i . "</a></li>";
            }

            if ($numPagina == $paginas) {
                $paginacionInput .= "<li data-disabled='true' class='disabled-link'><a href='../controlador/controlador_galeria_imagenes.php?pagina=" . $avan  . "'>&raquo;</a></li></ul></section></div>";
            } else $paginacionInput .= "<li><a href='../controlador/controlador_galeria_imagenes.php?pagina=" . $avan  . "'>&raquo;</a></li></ul></section></div>";
        }


        echo $paginacionInput;
    } catch (PDOException $e) { //
        // mostrarem els errors
        echo "Error: " . $e->getMessage();
    }
}

function edicion()
{
    include_once("../model/modelo_sesion_iniciada.php");
    if (isset($_GET['edit'])) {
        $idart = $_GET['id'];
        $art = seleccionarArticuloUnico($idart);
        $articulo = $art->fetch();

        if ($articulo['rutaImagen'] != '../src/claqueta_accion.png') {
            unlink($articulo['rutaImagen']);
        }
        eliminarArticulo($idart);
    }
}
