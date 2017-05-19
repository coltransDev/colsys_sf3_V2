<div class="pregunta" id="<?=$pregunta->ca_id?>">
    <label class="intro-pregunta">
        <?php if ($pregunta->ca_obligatoria == 'true') { ?>
        <span class="pregunta-obligatoria">*</span>
        <?php } ?>
        <?php echo html_entity_decode($pregunta->ca_texto) ?>
    </label>
    <label class="comentario-pregunta"><?php echo html_entity_decode($pregunta->ca_ayuda); ?></label>
</div>
<div class="campos-pregunta" id="p_<?php echo html_entity_decode($pregunta->ca_id) ?>">
    <?php
    if ($pregunta->ca_tipo == 0) {
    //numero
    include_partial('pregunta/pNumero', array('pregunta' => $pregunta));
    }
    if ($pregunta->ca_tipo == 1) {
    //texto
    include_partial('pregunta/pTexto', array('pregunta' => $pregunta));
    } if ($pregunta->ca_tipo == 2) {
    //email
    include_partial('pregunta/pEmail', array('pregunta' => $pregunta));
    } if ($pregunta->ca_tipo == 3) {
    //parrafo
    include_partial('pregunta/pParrafo', array('pregunta' => $pregunta));
    } if ($pregunta->ca_tipo == 4) {
    //test
    include_partial('pregunta/pTest', array('pregunta' => $pregunta));
    } if ($pregunta->ca_tipo == 5) {
    //casillas de verificacion
    include_partial('pregunta/pMultiple', array('pregunta' => $pregunta));
    } if ($pregunta->ca_tipo == 6) {
    //lista desplegable
    include_partial('pregunta/pListaDesplegable', array('pregunta' => $pregunta));
    } if ($pregunta->ca_tipo == 7) {
    //escala
    include_partial('pregunta/pEscala', array('pregunta' => $pregunta));
    } if ($pregunta->ca_tipo == 8) {
    //cuadrIcula
    include_partial('pregunta/pEstrella', array('pregunta' => $pregunta, 'servicios' => $servicios, "formulario"=>$formulario));
    }
    if ($pregunta->ca_tipo == 9) {
    //cuadrIcula
    include_partial('pregunta/pCuadricula', array('pregunta' => $pregunta));
    }
    ?>
</div>
