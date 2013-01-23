<form class="formulario" id="<?php echo $formulario->ca_id ?>" action="procesoservicio" method="post">
    <!--<p class="nombre-formato"><? //php echo $formulario->ca_nombre_formato                      ?></p>
    <p class="fecha-formato"><? //php echo $formulario->ca_nombre_formato                      ?></p>-->
    <div class="formulario-cabecera">
        <img class="logo-topmenu" src="/images/coltrans.png" alt="Coltrans SA" />
        <h1><?php echo $formulario->ca_titulo ?></h1>
        <div class="intro-formulario"><?php echo html_entity_decode($formulario->ca_introduccion) ?></div>
    </div>
    <div class="mensaje-obligatorio"><span class="pregunta-obligatoria">*</span>Campo Obligatorio</div>
    <?php
    if ($tipo_bloque == 1) {
        $bloque = $formulario->getBloqueServicio($formulario->ca_id);
        include_partial('bloque/vistaPreviaBloque', array('bloque' => $bloque));
    } else {
        foreach ($formulario->getBloques($formulario->ca_id) as $bloque):
            include_partial('bloque/vistaPreviaBloque', array('bloque' => $bloque));
        endforeach;
    }
    ?>

    <div class="submitForm">
        <input class="button" type="submit" value="Enviar" />
    </div>
</form>










