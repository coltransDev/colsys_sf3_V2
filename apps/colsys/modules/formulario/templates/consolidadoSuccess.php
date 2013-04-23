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
                    <th>No</th>
                    <th>Id Respuesta</th>
                    <th>Id Contacto</th>
                    <th>Compañía</th>
                    <th>Nombre Contacto </th>
                    <th>Email</th>
                    <th>Usuario R. ventas</th>
                    <th>Nombre R. ventas</th>
                    <th>Ciudad</th>
                    <th>Fecha Respuesta</th>
                    <th>Pregunta</th>
                    <th>Respuesta</th>
                    <th>Servicio</th>
                </tr>
            </thead>
            <tbody>
                <? $i = 0 ?>
                <? foreach ($c_encuestas as $encuesta): ?>
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
                <? endforeach; ?>
            </tbody>
        </table>

    <? } ?>
</div>