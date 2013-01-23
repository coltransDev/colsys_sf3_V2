<form class="formulario" id="f_<?php echo $formulario->ca_id ?>" action="<?php echo url_for('formulario/proceso?id=' . base64_encode($formulario->getCaId()).'&co='.$contacto) ?>" method="post">

    <!--<p class="nombre-formato"><? //php echo $formulario->ca_nombre_formato                    ?></p>
    <p class="fecha-formato"><? //php echo $formulario->ca_nombre_formato                    ?></p>-->
    <div class="formulario-cabecera">
        <img class="logo-topmenu" src="/images/logos/coltrans.png" alt="Coltrans SA" />
        <h1><?php echo $formulario->ca_titulo ?></h1>
        <div class="intro-formulario"><?php echo html_entity_decode($formulario->ca_introduccion) ?></div>
    </div>
    <div class="mensaje-obligatorio"><span class="pregunta-obligatoria">*</span>Campo Obligatorio</div>
    <?php foreach ($formulario->getBloquesOrdenados($formulario->ca_id) as $bloque): ?>
        <?php
        include_partial('bloque/vistaPreviaBloque', array('bloque' => $bloque, 'servicios' => $servicios));
        ?>
    <?php endforeach; ?>
    <? //php echo $email?>
    <? //php echo $servicio?>


    <div class="submitForm">
        <input class="button" type="submit" value="Enviar" />
    </div>

</form>











