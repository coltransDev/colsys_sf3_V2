<tr>
    <td>
        <? echo $formulario->displaySucursal($sucursal) ?> 
    </td>    
    <td style="text-align: center">
        <?   
            echo $formulario->getNumEmpresasEnviadasPorSucursal($lista_empresas, $sucursal);
        ?>
    </td>
    <td style="text-align: center">
        <? 
        if($sucursal != '0') {
            echo $formulario->getNumEncuestasEnviadasPorSucursal($lista_encuestas, $sucursal);
        } else {
            foreach ($encuestas as $encuesta):
                echo $encuesta['enviados'];
            endforeach;
        }
        ?>
    </td>
    <td style="text-align: center">
        <?
          /*if ($sucursal == 'NA') {
            echo "-";
        } else {*/
            echo sizeof($formulario->getListaContactosRespuesta($sucursal));
        /*}*/
        ?>
    </td>
    <!--<td><p class=""><? //echo $formulario->getnumEncuestasDiligenciadas($sucursal, null, null, $formulario->getCaId()) ?></p></td>-->
    <td style="text-align: center">
        <? 
        if($servicio==null){
            $dservicio='0';
        }
        else{
            $dservicio=$servicio->getCaId();
        }
        ?>
        <a class="" target="_blank" href="<? echo url_for('formulario/contactos?ca_id=' . base64_encode($formulario->getCaId()) . '&sid=' . $formulario->encodeSucursal($sucursal)  . '&pid=' . $p_pregunta . '&seid=' . $dservicio) ?>"><img title="Contactos que respondieron la encuesta" title="Contactos que respondieron la encuesta" src="/images/formularios/contacts.png"></a>
    </td>
</tr>