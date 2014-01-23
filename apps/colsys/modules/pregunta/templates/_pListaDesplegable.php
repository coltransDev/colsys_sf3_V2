<? include_partial('pregunta/error', array('pregunta' => $pregunta)); ?>
<select class="lista-desplegable" name="en0<? echo $pregunta->ca_id ?>sencillo" id="en_<? echo $pregunta->ca_id ?>" obligatorio="<?=$pregunta->ca_obligatoria?>" idpregunta="<?=$pregunta->ca_id?>">
     <option class="select-option" value="">seleccione una opci&oacute;n</option>
    <? foreach ($pregunta->getOpcionesOrdenadas($pregunta->ca_id) as $opcion): ?>
        <option class="select-option" value="<? echo html_entity_decode($opcion->ca_texto) ?>"><? echo html_entity_decode($opcion->ca_texto) ?></option>
    <? endforeach; ?>
</select>


<? if ($pregunta->ca_comentarios==true) { ?>
<p class="parrafo area-adicional"> Si su respuesta elegida fue la opci&oacute;n "f) Otra", por favor ind&iacute;quenos su preferencia</p>
<textarea class="parrafo area-adicional" id="en_<? echo $pregunta->ca_id ?>"   name="en0<? echo $pregunta->ca_id ?>sencilloOtra"></textarea>
<?  }if($pregunta->ca_tipo==6){ ?>
<p class="parrafo area-adicional"> Comentarios adicionales</p>
<textarea class="parrafo area-adicional" id="en_<?php echo $pregunta->ca_id ?>"   name="en0<?php echo $pregunta->ca_id ?>sencilloComentario"></textarea>
<?}?>

