<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="../estil/estil_inici_sessio.css" type="text/css">
    <meta charset="UTF-8" />
    <title></title>
</head>
<script>
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
    <div>

        <!--Acciona l'arxiu 'controlador.php' quan es clica l'input amb type="submit" (botó d'enviar)-->
        <form action="../controlador/controlador_cambiar_nombre.php" method="post" class="firstForm">
            <h2>Canviar nom</h2>
            <div>

                <label>* Nou nom</label>
                <div>
                    <!-- Valor d'entrada amb el nom 'nom'. El value que conté dades php fa que en cas que detecti el valor de 'nom' amb la funció isset,
                        mostrarà el valor, en cas contrari mostra null (el valor estarà buit)  -->
                    <input type="text" name="nuevoNombre" value="">
                </div>
            </div>

            <div>
                <div>
                    <!-- Botó d'enviar la informació. Un cop clicat executarà l'arxiu 'controlador.php' especificat en action a l'obertura de l'etiqueta form-->
                    <input type="submit" onclick="return confirmarAccion()">
                </div>
            </div>
        </form>

        <form action="../vista/sesion_iniciada.php" method="post" class="thirthForm">
            <div>
                <input type="submit" value="Inici">
            </div>
        </form>
    </div>
</body>

</html>