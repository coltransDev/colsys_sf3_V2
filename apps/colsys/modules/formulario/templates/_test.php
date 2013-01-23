<?php
echo 'servicios:' . $servicios[3];
echo 'la cantidad es:' . $cantidad;
echo $formulario->ca_titulo;
echo $formulario->ca_introduccion;
//include_partial('formulario/vistaPreviaFormulario', array('formulario' => $formulario));
?>

<form class="formulario" id="<?php echo $formulario->ca_id ?>" action="proceso" method="post">
    <!--<p class="nombre-formato"><? //php echo $formulario->ca_nombre_formato                        ?></p>
    <p class="fecha-formato"><? //php echo $formulario->ca_nombre_formato                        ?></p>-->
    <div class="formulario-cabecera">
        <img class="logo-topmenu" src="/images/coltrans.png" alt="Coltrans SA" />
        <h1><?php echo $formulario->ca_titulo ?></h1>
        <div class="intro-formulario"><?php echo html_entity_decode($formulario->ca_introduccion) ?></div>
    </div>
    <div class="mensaje-obligatorio"><span class="pregunta-obligatoria">*</span>Campo Obligatorio</div>
    <?php foreach ($formulario->getBloquesOrdenados($formulario->ca_id) as $bloque): ?>
        <?php $pregunta = $bloque->getPrimeraPreguntaBloque(); ?>
        <div class="pregunta">
            <label class="intro-pregunta">
                <?php echo html_entity_decode($pregunta->ca_texto) ?>
            </label>
            <label class="comentario-pregunta"><?php echo html_entity_decode($pregunta->ca_ayuda); ?></label>
        </div>
        <?php include_partial('pregunta/error', array('pregunta' => $pregunta)); ?>
        <input class="texto" type="number" id="entrada_<?php echo $pregunta->ca_id ?>"  value="" name="entrada.<?php echo $pregunta->ca_id ?>.sencillo">
        <script type="text/javascript">

            var pregunta = new LiveValidation('entrada_<?php echo $pregunta->ca_id ?>',{ validMessage: "OK!"});
            pregunta.add( Validate.Numericality);
    <?php if ($pregunta->ca_obligatoria == 'true') { ?>
            pregunta.add( Validate.Presence);
            </script>
        <?php } ?>

    </script>



<?php endforeach; ?>
<div class="submitForm">
    <input class="button" type="submit" value="Enviar" />
</div>
</form>


<?php
//echo $mensaje;
?>
<!--<h1>texto insertado desde parcial _test</h1>-->
<?php
//echo 'el id del formulario es: '.$idFormulario;
?>