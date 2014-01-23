<tr>
    <td>
        <? echo $formulario->displaySucursal($sucursal) ?> 
    </td>    
    <td>
        <?
        if ($p_pregunta != '0' && $pregunta) {
            echo /*$pregunta->getCaId() . " : " .*/ html_entity_decode($pregunta->getCaTexto());
        } else {
            echo "Todas";
        }
        ?>
    </td>
    <td>
        <?
        if ($p_servicio != '0' && $servicio) {
            echo html_entity_decode($servicio->ca_texto);
        } else {
            echo "Todos";
        }
        ?>
    </td>
    <?
    $promedio_general = 0;
    foreach ($formulario->getPromedio($sucursal, $p_pregunta, $servicio, null) as $encuesta):
        if ($encuesta['count'] == 0) {
            $promedio_general = 'No Hay preguntas con estos críterios';
        }
        else
            $promedio_general = $encuesta['avg'];
        ?>       
    <? endforeach; ?>


    <td><p class="resultado_encuesta"><? echo sizeof($formulario->getListaContactosRespuesta($sucursal)) ?></p></td>
    <td><p class="resultado_encuesta"><? echo $encuesta['count'] ?></p></td>
    <td><p class="resultado_vacio"><?= ($encuesta['avg'] == "") ? "0" : round($encuesta['avg'],2) ?></p></td>
    <? if($servicio == null) {?>
    <td style="text-align: center"><a class="" target="_blank" href="<? echo url_for('formulario/consolidado?ca_id=' . base64_encode($formulario->getCaId()).'&sid=' . $formulario->encodeSucursal($sucursal).'&pid=' . $p_pregunta.'&seid=' . $p_servicio) ?>"><img title="Consolidado de respuestas" title="Consolidado de respuestas" src="/images/formularios/consolidado.png"></a></td> 
    <? } else { ?>
    <td style="text-align: center"><a class="" target="_blank" href="<? echo url_for('formulario/consolidado?ca_id=' . base64_encode($formulario->getCaId()).'&sid=' . $formulario->encodeSucursal($sucursal).'&pid=' . $p_pregunta.'&seid=' . $servicio->getCaId()) ?>"><img title="Consolidado de respuestas" title="Consolidado de respuestas" src="/images/formularios/consolidado.png"></a></td> 
    <? } ?> 
</tr>