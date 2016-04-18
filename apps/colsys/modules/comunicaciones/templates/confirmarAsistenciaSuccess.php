<? 
    if (!$aceptacion) {
        if (!$respuesta) { 
            ?>
            <form class="formulario" id="form_confirmar" action="<?= url_for('comunicaciones/confirmarAsistencia?aceptacion=si&idenvio='.$idenvio.'&idcontacto=' . $contacto->getCaIdcontacto() . '&idcliente=' . $contacto->getCaIdcliente()) ?>" method="post">
                <div class="formulario-cabecera">
                    <img src="http://www.coltrans.com.co/images/logos/coltrans/coltrans-web.png">
                    <img src="http://www.coltrans.com.co/logosoficiales/colmas/ColmasMed.png" align="right">
                </div>
                <h1>Confirmaci&oacute;n de Asistencia</h1>
                <div class="intro-formulario">
                    <? if ($cliente) {
                        ?>
                        Estimado Sr (a) <b><?= $contacto->getCaNombres() ?> <?= $contacto->getCaPapellido() ?> <?= $contacto->getCaSapellido() ?>:</b><br />
                        Gracias por aceptar nuestra invitaci&oacute;n.<br /><br />
                        Para finalizar la confirmaci&oacute;n por favor de click en el botón Confirmar.<br />
                        <!--<textarea class="parrafo area-adicional" id="comentarios"   name="comentarios"></textarea><br/>-->
                        <div class="submitForm">
                            <input class="button" type="submit" value="Confirmar" />
                            <!--<input class="button" type="button" value="Confirmar" onclick="validarFormulario()"/>-->
                            <input class="button" type="button" value="Cancelar" onclick="redirigir()" />
                        </div>
                        <?
                    } else {
                        ?>
                        La información del contacto no coincide con el Nit del Cliente
                        <?
                    }
                    ?>
                </div>
            </form>
            <?
        } else { 
            ?>
            <form class="formulario" id="form_aceptar" >
                <div class="formulario-cabecera">
                    <img src="http://www.coltrans.com.co/images/logos/coltrans/coltrans-web.png">
                    <img src="http://www.coltrans.com.co/logosoficiales/colmas/ColmasMed.png" align="right">
                </div>
                <h1>Error de Confirmaci&oacute;n</h1>
                <div class="intro-formulario">
                    <?=$respuesta?>
                </div>
            </form>
        <?
        } 
    } else {
        if(!$respuesta){
            ?>
            <form class="formulario" id="form_aceptar" >
                <div class="formulario-cabecera">
                    <img src="http://www.coltrans.com.co/images/logos/coltrans/coltrans-web.png">
                    <img src="http://www.coltrans.com.co/logosoficiales/colmas/ColmasMed.png" align="right">
                </div>
                <h1>Confirmaci&oacute;n Exitosa</h1>
                <div class="intro-formulario">
                    Su confirmaci&oacute;n ha sido registrada correctamente.
                    Lo esperamos!!
                </div>
                <div class="submitForm">
                    <input class="button" type="button" value="Salir" onclick="redirigir()" />
                </div>
            </form>
            <?
        }else{
            ?>
            <form class="formulario" id="form_aceptar" >
                <div class="formulario-cabecera">
                    <img src="http://www.coltrans.com.co/images/logos/coltrans/coltrans-web.png">
                    <img src="http://www.coltrans.com.co/logosoficiales/colmas/ColmasMed.png" align="right">
                </div>
                <h1>Error de Confirmaci&oacute;n</h1>
                <div class="intro-formulario">
                    <?=$respuesta?>
                </div>
            </form>
            <?
        }
    } 
?>
<script>
    function validarFormulario() {
        var obj = document.getElementById("comentarios").value;

        if (obj == '') {
            alert("Es indispensable confirmar el número de documento para acceder a las instalaciones.");
        } else {
            document.getElementById("form_confirmar").submit();
        }
    }

    function redirigir() {
        window.location = "http://www.coltrans.com.co";
    }
</script>