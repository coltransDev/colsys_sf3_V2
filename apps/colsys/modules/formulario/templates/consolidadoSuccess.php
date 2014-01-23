<? if ($sf_user->hasFlash('notice')): ?>
    <div class="flash_notice">
        <? echo $sf_user->getFlash('notice') ?>
    </div>
<? endif; ?>
<div class="resultado-estadistica">
    <h1>Consolidado de respuestas al formulario "<? echo $formulario->ca_titulo ?>"</h1>
    <br>
    <table border="1" class="listado">
        <thead>
            <tr>
                <th>Sucursal</th>
                <th>Servicio</th>
                <th>Pregunta</th>
                <!--<th>Acciones</th>-->
            </tr>
        </thead>
        <tbody>
            <? $i = 0 ?>
            <tr>
                <td>
                    <? echo $formulario->displaySucursal($sucursal) ?>
                </td>
                <td>
                    <?
                    if ($p_servicio != '0') {
                        echo html_entity_decode($servicio->ca_texto);
                    } else {
                        echo "Todos";
                    }
                    ?>
                </td>     
                <td><? echo html_entity_decode($lPregunta) ?></td>
                <!--<td>
                    <a class="" target="_blank" href="<? echo url_for('formulario/resultado?ca_id=' . $control['ca_id']) ?>"><img title="Descargar excel" title="Descargar Excel" src="/images/formularios/to_excel.gif"></a>
                </td>-->
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <? if ($control->contarEncuestas($formulario->ca_id) == 0) {
        ?>
        <p class="resultado_vacio"> </p>
    <? } else { ?>
        <table border="1" class="listado">
            <thead>
                <tr>
                    <th></th>
                    <th>Pregunta</th>
                    <th>Nombre Contacto </th>
                    <th>Email</th>
                    <th>Fecha Respuesta</th>
                    <th>Respuesta</th>
                </tr>
            </thead>
            <tbody>
                <? $i = 0 ?>
                <?/* foreach ($c_encuestas as $encuesta): ?>
                    <? $i++; ?>
                    <? if ($encuesta['ca_resultado'] != "") { ?>
                        <tr>
                            <td><? echo $i ?></td>
                            <td><? echo $encuesta['ca_id'] ?></td>
                            <td><? echo $encuesta['ca_idcontacto'] ?></td>
                            <td><? echo $encuesta['ca_compania'] ?></td>
                            <td><? echo $encuesta['ca_nombres'] . ' ' . $encuesta['ca_papellido'] . ' ' . $encuesta['ca_sapellido'] ?></td>
                            <td><? echo $encuesta['ca_email'] ?></td>
                            <td><? echo $encuesta['ca_vendedor'] ?></td>
                            <td><? echo $encuesta['ca_nombrevendedor'] ?></td>
                            <td><? echo $encuesta['ca_ciudad'] ?></td>
                            <td><? echo $encuesta['ca_fchcreado'] ?></td>
                            <td><? echo html_entity_decode($encuesta['ca_texto']) ?></td>
                            <td><? echo $encuesta['ca_resultado'] ?></td>
                            <td><? echo $encuesta['ca_servicio'] ?></td>
                        </tr>
                    <? } ?>
                <? endforeach; */?>
                <?
                $lastComercial = "";
                $lastCompania = "";
                $lastServicio = "";
                    foreach ($c_encuestas as $encuesta){
                    if( $lastComercial!=$encuesta['ca_nombrevendedor'] ){
                        $lastComercial=$encuesta['ca_nombrevendedor'];
                    ?>
                        <tr>
                            <td style="text-align: left; color: blue; font-size:20px;"  colspan="6">
                                <?=$lastComercial?>
                            </td>
                        </tr>
                    <?
                    }
                    if($lastCompania != $encuesta['ca_compania']){
                        $lastCompania = $encuesta['ca_compania'];
                    ?>
                        <tr>
                            <td colspan="6" style="color: #062A7D; font-size:18px;" >
                                &nbsp;<?=$lastCompania?>
                            </td>
                        </tr>
                    <?
                    }
                    if($lastServicio != $encuesta['ca_servicio']){
                        $lastServicio = $encuesta['ca_servicio'];
                    ?>
                        <tr>
                            <td colspan="6" style="color: #062A7D; font-size:12px;" >
                                &nbsp;&nbsp;<?="Servicio: ".$lastServicio?>
                            </td>
                        </tr>
                    <?
                    }
                    ?>
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td><?=html_entity_decode($encuesta['ca_texto'])?></td>
                        <td><?=$encuesta['ca_nombres'] . ' ' . $encuesta['ca_papellido']?></td>
                        <td><?=$encuesta['ca_email'] ?></td>
                        <td><?=$encuesta['ca_fchcreado'] ?></td>
                        <td><?=$encuesta['ca_resultado'] ?></td>
                    </tr>
            <?}?>
            </tbody>
        </table>

    <? } ?>
</div>