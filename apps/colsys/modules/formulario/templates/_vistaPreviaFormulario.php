<form class="formulario" id="f_<? echo $formulario->ca_id ?>" action="<? echo url_for('formulario/proceso?id=' . base64_encode($formulario->getCaId()) . '&co=' . $contacto) ?>" method="post">
    <div class="formulario-cabecera">
        <? if ($formulario->ca_empresa == 1) { ?>
            <img class="logo-topmenu" src="/images/logos/colmas.png" alt="Colmas SA" />    
        <? } else { ?>
            <img class="logo-topmenu" src="/images/logos/coltrans.png" alt="Coltrans SA" />
        <? } ?>

        <h1><? echo $formulario->getCaAlias() ?></h1>
        <div class="intro-formulario"><? echo html_entity_decode($formulario->ca_introduccion) ?></div>
    </div>
    <div class="mensaje-obligatorio"><span class="pregunta-obligatoria">*</span>Campo Obligatorio</div>
    <? foreach ($formulario->getBloquesOrdenados($formulario->ca_id) as $bloque): ?>
        <?
        include_partial('bloque/vistaPreviaBloque', array('bloque' => $bloque, 'servicios' => $servicios));
        ?>
    <? endforeach; ?>
    <? //php echo $email?>
    <? //php echo $servicio?>

    <div class="submitForm">
        <input class="button" type="submit" value="Enviar" />
    </div>

</form>











