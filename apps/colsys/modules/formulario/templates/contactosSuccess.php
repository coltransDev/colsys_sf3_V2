<?php if ($sf_user->hasFlash('notice')): ?>
    <div class="flash_notice">
        <?php echo $sf_user->getFlash('notice') ?>
    </div>
<?php endif; ?>
<div class="resultado-estadistica">
    <br>
    <br>
    <? if (sizeof($contactos) > 0) { ?>   
        <h1>Listado de Contactos que respondieron el formulario "<?php echo $formulario->ca_titulo ?>" para la sucursal "<? echo $formulario->displaySucursal($sucursal) ?>" </h1>
    <? } else { ?> 
        <? if ($sucursal != '0') { ?>
            <h3 class="resultado_vacio">No hay contactos de la sucursal <? echo $sucursal; ?> que hallan respondido la encuesta</h3>
        <? } else { ?> 
            <h3 class="resultado_vacio">No hay contactos que hallan respondido la encuesta</h3> 
        <? } ?> 
    <? } ?>          

<? $z = 0 ?>
<? if (sizeof($contactos) > 0) { ?>

        <table border="1" class="listado">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Respuesta</th>
                    <th>Empresa</th>
                    <th>Nombre</th>
                    <th>Sucursal</th>
                    <th>Representante de ventas</th>
                    <th>Fecha en que se diligencio</th>
                    <th>Promedio Encuesta</th>
                    <th>Promedio con filtros</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <? foreach ($contactos as $control): ?>
                    <?
                    $z++;
                    //$respuesta = $formulario->getPromedio($control['ca_id']);
                    ?>
                    <tr>
                        <td><? echo $z ?></td>
                        <td><? echo $control['ca_id'] ?></td>
                        <td><? echo $control['ca_nombre'] ?></td>
                        <td><? echo $control['ca_nombres'] . ' ' . $control['ca_papellido'] . ' ' . $control['ca_sapellido'] ?></td>
                        <td><? echo $control['sucursal'] ?></td>
                        <td><? echo $control['representante'] ?></td>
                        <td><? echo $control['ca_fchcreado'] ?></td>

                        <?
                        foreach ($formulario->getPromedio(0, 0, 0, $control['ca_id']) as $encuesta):
                        endforeach;
                        ?>
                        <td><p class="resultado_vacio"><? echo round($encuesta['avg'], 2) ?></p></td>
                        <?
                        foreach ($formulario->getPromedio($sucursal, $pregunta, $servicio, $control['ca_id']) as $encuesta):
                        endforeach;
                        ?>
                        <td><p class="resultado_vacio"><?= ($encuesta['avg'] == "") ? "-" : round($encuesta['avg'], 2) ?></p></td>
                        <td>
                            <a class="" target="_blank" href="<? echo url_for('formulario/resultado?ca_id=' . $control['ca_id']) ?>"><img title="Ver respuesta" title="Ver respuesta" src="/images/formularios/respuesta.png"></a>
                        </td>
                    </tr>
        <? endforeach; ?>
            </tbody>
        </table>
<? } ?>
</div>