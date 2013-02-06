<? include_partial('pregunta/error', array('pregunta' => $pregunta)); ?>
<ul class="seleccion_multiple">
    <? $cont = 1; ?>
    <? foreach ($pregunta->getOpcionesOrdenadas($pregunta->ca_id) as $opcion): ?>
        <li class="box-item">
            <label class="box-label">
                <input type="checkbox" id="grupo_<? echo $pregunta->ca_id ?>_<? echo $cont ?>" class="checkbox" value="<? echo html_entity_decode($opcion->ca_texto) ?>" name="<? echo $cont ?>">
                <? echo html_entity_decode($opcion->ca_texto) ?>
            </label>
        </li>
        <? $cont++; ?>
    <? endforeach; ?>
</ul>

<script>
    function verificar_pmultiple_servicios(){
        var inputs = document.getElementById("f_<? echo $pregunta->getBloque()->getFormulario()->getCaId() ?>").elements;
        var i=0, j=0;
        if( <? echo $pregunta->getBloque()->getCaTipo() ?> ==1){
            for(i;i<inputs.length;i++){
                if(inputs[i].type == 'checkbox')
                {
                    if (inputs[i].checked == false)
                    {
                        j++;
                    }
                }
            }
            if(j==<? echo sizeof($pregunta->getTbOpciones()) ?>){
                document.getElementById('error_32').innerHTML="<p>Debe seleccionar por lo menos un servicio para continuar!!!</p>";
               
                alert("Debe seleccionar almenos un servicio");
                return false;
            }
            else {
                return true;
            }
        } 
        return true;
    }

</script>
