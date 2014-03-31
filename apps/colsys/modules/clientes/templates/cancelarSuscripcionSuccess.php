<? if (!$aceptacion) { 
    ?>
    <form class="formulario" id="form_cancelar" action="<?= url_for('clientes/cancelarSuscripcion?aceptacion=si&idcontacto=' . $contacto->getCaIdcontacto() . '&idcliente=' . $contacto->getCaIdcliente()) ?>" method="post">
        <div class="formulario-cabecera">
            <img class="logo-topmenu" src="/images/logos/grupo_empresarial.png" alt="Grupo" />
        </div>
        <h1>Cancelación de Suscripción</h1>
        <div class="intro-formulario">
            <? if ($cliente) {
                ?>
                Estimado Sr (a) <b><?= $contacto->getCaNombres() ?> <?= $contacto->getCaPapellido() ?> <?= $contacto->getCaSapellido() ?>:</b><br />
                Nuestra base de datos lo tiene registrado como contacto de nuestro cliente <?= $cliente->getCaCompania() ?><br /><br />
                Sus comentarios son muy importantes para nosotros:<br />
                <textarea class="parrafo area-adicional" id="comentarios"   name="comentarios"></textarea><br/>
                <input style="width: 4%;" type="checkbox" name="masiva" value="masiva">Marque ésta opción si <b>NO</b> desea volver a recibir éste tipo de Comunicaciones.<br>
                <div style="font-size: 9px; color:red;">
                    Nota: Los status, confirmaciones e información propia de las operaciones seguirán reportándose correctamente.
                </div>
                
                <div class="submitForm">
                    <input class="button" type="button" value="Enviar" onclick="validarFormulario()" />
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
<? } else { 
    ?>
    <form class="formulario" id="form_aceptar" >
        <div class="formulario-cabecera">
            <img class="logo-topmenu" src="/images/logos/colmas.png" alt="Grupo" />
        </div>
        <h1>Solicitud Registrada</h1>
        <div class="intro-formulario">
            Su solicitud ha sido registrada correctamente y ya le fue notificada al Representante Comercial.
            Agradecemos mucho su tiempo.
        </div>
        <div class="submitForm">
            <input class="button" type="button" value="Salir" onclick="redirigir()" />
        </div>
    </form>
    <?
    } 
?>
<script>
    function validarFormulario() {
        var obj = document.getElementById("comentarios").value;

        if (obj == '') {
            alert("Sus comentarios son muy importantes para nosotros");
        } else {
            document.getElementById("form_cancelar").submit();
        }
    }

    function redirigir() {
        window.location = "http://www.coltrans.com.co";
    }
</script>