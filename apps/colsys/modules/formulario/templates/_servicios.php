<form class="formulario" id="f_<?php echo $formulario->ca_id ?>" action="<?php echo url_for('formulario/servicios?id=' . base64_encode($formulario->getCaId())) ?>" method="post">

    <!--<p class="nombre-formato"><? //php echo $formulario->ca_nombre_formato                  ?></p>
    <p class="fecha-formato"><? //php echo $formulario->ca_nombre_formato                  ?></p>-->
    <div class="formulario-cabecera">
        <img class="logo-topmenu" src="https://www.coltrans.com.co/logosoficiales/coltrans/Coltrans30anos_medium.jpg" alt="Coltrans SA" />
        <h1><?php echo $formulario->ca_titulo ?></h1>
        <div class="intro-formulario"><?php echo html_entity_decode($formulario->ca_introduccion) ?></div>
    </div>
    <div class="mensaje-obligatorio"><span class="pregunta-obligatoria">*</span>Campo Obligatorio</div>

        <?php
        include_partial('bloque/vistaPreviaBloque', array('bloque' => $bloque));
        ?>

        <?php echo $email?>
    <?php echo $servicio?>
    <input class="button" id="" type="hidden" name="" value="<?php echo $email?>"  />
    <input class="button" id="" type="hidden" name="" value="<?php echo $servicio?>"
    <input class="button" id="" type="hidden" name="" value="<?php echo $formulario->ca_id?>" />
   
    <div class="submitForm">
        <input class="button" type="submit" value="Continuar" />
    </div>

</form>











