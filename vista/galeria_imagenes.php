<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../estil/estils.css"> <!-- feu referència al vostre fitxer d'estils -->
	<title>Paginació</title>
</head>

<body>
	<?php
	/**
	 * @author Martín Hernan Jaime Bonvin
	 * @version 4.0
	 */

	require_once("../controlador/controlador_galeria_imagenes.php");
	?>
	<header>
		<?php opcionesHeader(); ?>
	
	</header>

	<div class="contenidor">
		<h1>Galeria d'imatges</h1>

		<?php
		require_once("../model/modelo_principal.php");
		mostrarImagenes();
		?>

	</div>
</body>

</html>