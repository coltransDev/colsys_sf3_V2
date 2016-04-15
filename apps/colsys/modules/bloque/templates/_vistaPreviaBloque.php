<? if ($bloque->getProperty("titulo")) { 
    ?>
    <span style="font-size: 12px; font-weight: bold;"><?= html_entity_decode($bloque->ca_titulo) ?></span>
    <? 
    } 
?>
<div class="bloque" id="b_<?= html_entity_decode($bloque->ca_id) ?>">
    <p class="intro-bloque"><?= html_entity_decode($bloque->ca_introduccion) ?></p>
    <?
    foreach ($bloque->getPreguntasOrdenadas($bloque->ca_id) as $pregunta) {
        include_partial('pregunta/vistaPreviaPregunta', array('pregunta' => $pregunta, 'servicios' => $servicios, 'formulario' => $formulario));
    }
    ?>
</div>
<? if ($bloque->ca_tipo == 1) { ?>
    <div id="indicator" style="display: none"></div>
<? } ?>