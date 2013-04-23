<? //print_r($encuestas)."HOLA";    ?>
<tr>
    <td>
        <? echo $formulario->displaySucursal($sucursal) ?> 
    </td>    
    <td>
        <?   
            //echo $formulario->getNumEMpresasEnviadasPorSucursal($sucursal, $formulario->getCaEmpresa());;
            echo $formulario->getNumEmpresasEnviadasPorSucursal($lista_empresas, $sucursal, $formulario->getCaEmpresa());
        ?>
    </td>
    <td>
        <? 
        //if($sucursal != '0') {
            echo $formulario->getNumEncuestasEnviadasPorSucursal($lista_encuestas, $sucursal, $formulario->getCaEmpresa());
        /*} else {
            foreach ($encuestas as $encuesta):
                echo $encuesta['enviados'];
            endforeach;
        }*/
        ?>
    </td>
    <td>
        <?
          if ($sucursal == 'NA') {
            echo'-';
        } else {
            echo $formulario->getnumEmpresasRespuesta($sucursal);
        }
        ?>
    </td>
    <td><p class=""><? echo $formulario->getnumEncuestasDiligenciadas($sucursal, null, null) ?></p></td>
    <td>
        <? 
        if($servicio==null){
            $dservicio='0';
        }
        else{
            $dservicio=$servicio->getCaId();
        }
        ?>
        <a class="" target="_blank" href="<? echo url_for('formulario/contactos?ca_id=' . base64_encode($formulario->getCaId()) . '&sid=' . $formulario->encodeSucursal($sucursal) . '&pid=' . $p_pregunta . '&seid=' . $dservicio) ?>"><img title="Contactos que respondieron la encuesta" title="Contactos que respondieron la encuesta" src="/images/formularios/contacts.png"></a>
    </td>
</tr>