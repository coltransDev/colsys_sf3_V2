<div class="bloque" id="b_<?php echo html_entity_decode($bloque->ca_id) ?>">
    <p class="intro-bloque"><?php echo html_entity_decode($bloque->ca_introduccion) ?></p>
    <?php
    foreach ($bloque->getPreguntasOrdenadas($bloque->ca_id) as $pregunta):
        include_partial('pregunta/vistaPreviaPregunta', array('pregunta' => $pregunta, 'servicios' => $servicios));
    endforeach;
    ?>
</div>
<?php if ($bloque->ca_tipo==1){ ?>

<div id="indicator" style="display: none"></div>
<?php } ?>







