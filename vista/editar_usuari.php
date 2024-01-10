<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../estil/estils.css"> <!-- feu referència al vostre fitxer d'estils -->
	<title>Pt_06_MHJB</title>
</head>
<?php
	/**
	 * @author Martín Hernan Jaime Bonvin
	 * @version 4.0
	 */
	include_once("../controlador/controlador_editar_usuario.php");
	?>
<script>
	/**
     * Funció per confirmar l'acció.
     * @return boolean: retorna el boolean que s'hagi seleccionat.
     */
    function confirmarAccion() {
        if (confirm('Deseas continuar?')) {
            return true;
        } else {
            alert('Operacion Cancelada');
            return false;
        }
    }
</script>

<body>
	
	<header>
		<h2>Pt_06_Martín_Jaime</h2>
		<h3> <?php mostrarNombre(); ?> </h3>
		<a href="../vista/sesion_iniciada.php?nom=<?php echo $_SESSION['usuario'] ?>">INICI</a>
		<a href="../vista/index.vista.php">TANCAR SESSIÓ</a>
	</header>

	<div class="contenidor">
		<h1>Usuari</h1>
		<h2><?php echo $_SESSION['usuario'] ?></h2>

		<form action="../vista/cambiar_nombre.php" method="post" class="thirthForm">
			<div>
				<input type="submit" value="Canviar nom">
			</div>
		</form>

		<form action="../vista/cambiar_contraseña_usuario.php" method="post" class="thirthForm">
			<div>
				<input type="submit" value="Canviar contrasenya">
			</div>
		</form>

		<form action="" method="post" class="thirthForm">
			<div>
				<input type="submit" value="Editar articles">
			</div>
		</form>

		<form action="../controlador/controlador_eliminar_usuario.php" method="post" class="thirthForm">
			<div>
				<input type="submit" value="Esborrar usuari" onclick="return confirmarAccion()">
			</div>
		</form>

	</div>
</body>

</html>