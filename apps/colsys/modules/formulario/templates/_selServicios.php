<form class="formulario" id="f_<? echo $formulario->ca_id ?>" onsubmit="return verificar_pmultiple_servicios()" action="<?php echo url_for('formulario/encuesta?id=' . base64_encode($formulario->getCaId()).'&co='.$contacto) ?>" method="post">

    <!--<p class="nombre-formato"><? //php echo $formulario->ca_nombre_formato                  ?></p>
    <p class="fecha-formato"><? //php echo $formulario->ca_nombre_formato                  ?></p>-->
    <div class="formulario-cabecera">
        <? if ($formulario->ca_empresa == 1) { ?>
            <img class="logo-topmenu" src="/images/logos/colmas.png" alt="Colmas SA" />    
        <? } else { ?>
            <img class="logo-topmenu" src="/images/logos/coltrans.png" alt="Coltrans SA" />
        <? } ?>
        <h1><? echo $formulario->ca_alias ?></h1>
        <div class="intro-formulario">
            <? echo html_entity_decode($formulario->ca_introduccion) ?></div>
    </div>
    <div class="mensaje-obligatorio"><span class="pregunta-obligatoria">*</span>Campo Obligatorio</div>

        <?
        include_partial('bloque/vistaPreviaBloque', array('bloque' => $bloque));
        ?>

        <? echo $email?>
    <? echo $servicio?>
    <!--<input class="button" id="" type="hidden" name="" value="<?// echo $email?>"  />
    <input class="button" id="" type="hidden" name="" value="<?// echo $servicio?>"
    <input class="button" id="" type="hidden" name="" value="<?// echo $formulario->ca_id?>" />-->
   
    <div class="submitForm">
        <input class="button" type="submit" value="Continuar" />
    </div>

</form>











