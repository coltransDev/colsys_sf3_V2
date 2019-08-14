<? include_partial('pregunta/error', array('pregunta' => $pregunta)); ?>
<select onchange="mostrar(<?=$pregunta->ca_id?>)" class="lista-desplegable" name="en0<? echo $pregunta->ca_id ?>sencillo" id="en_<? echo $pregunta->ca_id ?>" obligatorio="<?=$pregunta->ca_obligatoria?>" idpregunta="<?=$pregunta->ca_id?>">
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

<script>
    
function mostrar(idpregunta){
    //se realiza para el formulario 17 la pregunta si ha tenido o no quejas y reclamos
    if(idpregunta == 143){
        var opcion = $("#en_"+idpregunta).val();
        var obj = $("input[id^='grupo_"+144+"']");
        var pregunta = $("div[id^="+144+"]");
        var campoPregunta = $("#p_"+144);
        
        if(opcion === "NO"){            
            pregunta.hide();            
            campoPregunta.hide();
            
            $.each( obj, function( key, el ) {                
                var j = $('input[name='+el.name+']');
                j.attr("obligatorio", 0); 
            });
            
        }else if(opcion === "SI"){
            pregunta.show();            
            campoPregunta.show();
            
            $.each( obj, function( key, el ) {                
                var j = $('input[name='+el.name+']');                
                j.attr("obligatorio", 1);                
            });
        }
    }
    //se realiza para el formulario 17 la pregunta si ha tenido o no quejas y reclamos
    if(idpregunta == 154){
        var opcion = $("#en_"+idpregunta).val();
        var obj = $("input[id^='grupo_"+155+"']");
        var pregunta = $("div[id^="+155+"]");
        var campoPregunta = $("#p_"+155);
        
        if(opcion === "NO"){            
            pregunta.hide();            
            campoPregunta.hide();
            
            $.each( obj, function( key, el ) {                
                var j = $('input[name='+el.name+']');
                j.attr("obligatorio", 0); 
            });
            
        }else if(opcion === "SI"){
            pregunta.show();            
            campoPregunta.show();
            
            $.each( obj, function( key, el ) {                
                var j = $('input[name='+el.name+']');                
                j.attr("obligatorio", 1);                
            });
        }
    }
}
</script>