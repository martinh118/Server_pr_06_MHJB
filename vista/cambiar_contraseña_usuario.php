
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
        <form action="../controlador/controlador_cambiar_contra_usuario2.php" method="post" class="firstForm">
            <h2>Recuperar contrasenya</h2>

            <div>
                <label>* Contrasenya actual</label>
                <div>
                    <input type="password" name="contraActual" >
                </div>
            </div>

            <div>
                <label>* Contrasenya nova</label>
                <div>
                    <input type="password" name="contraNueva">
                </div>
            </div>

            <div>
                <label>* Repetir contrasenya nova</label>
                <div>
                    <input type="password" name="reContraNueva">
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
