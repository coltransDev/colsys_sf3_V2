<?php if ($sf_user->hasFlash('notice')): ?>
    <div class="flash_notice">
        <?php echo $sf_user->getFlash('notice') ?>
    </div>
<?php endif; ?>
<div class="resultado-estadistica">
    <h1>Consolidado de respuestas al formulario "<?php echo $formulario->ca_titulo ?>"</h1>
    <br>
    <table border="1" class="listado">
        <thead>
            <tr>
                <th>No de encuestas enviadas</th>
                <th>No de contactos únicos</th>
                <th>No de encuestas diligenciadas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0 ?>
            <tr>
                <td>
                    <? foreach ($encuestas_enviadas as $encuesta_enviada): ?>
                        <? echo $encuesta_enviada['enviados'] ?>
                    <? endforeach; ?>
                </td>
                <td>
                    <? foreach ($encuestas_unicas_enviadas as $encuesta_unica_enviada): ?>
                        <? echo $encuesta_unica_enviada['unicas'] ?>
                    <? endforeach; ?>
                </td>     
                <td><?php echo $encuestas_diligenciadas ?></td>
                <td>
                    <a class="" target="_blank" href="<?php echo url_for('formulario/resultado?ca_id=' . $control['ca_id']) ?>"><img title="Descargar excel" title="Descargar Excel" src="/images/formularios/to_excel.gif"></a>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <?php if ($control->contarEncuestas($formulario->ca_id) == 0) {
        ?>
        <p class="resultado_vacio"> </p>
    <?php } else { ?>
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
                <?php $i = 0 ?>
                <?php foreach ($c_encuestas as $encuesta): ?>
                    <?php $i++; ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $encuesta['ca_id'] ?></td>
                        <td><?php echo $encuesta['ca_idcontacto'] ?></td>
                        <td><?php echo $encuesta['ca_compania'] ?></td>
                        <td><?php echo $encuesta['ca_nombres'] . ' ' . $encuesta['ca_papellido'] . ' ' . $encuesta['ca_sapellido'] ?></td>
                        <td><?php echo $encuesta['ca_email'] ?></td>
                        <td><?php echo $encuesta['ca_vendedor'] ?></td>
                        <td><?php echo $encuesta['ca_nombrevendedor'] ?></td>
                        <td><?php echo $encuesta['ca_ciudad'] ?></td>
                        <td><?php echo $encuesta['ca_fchcreado'] ?></td>
                        <td><?php echo html_entity_decode($encuesta['ca_texto']) ?></td>
                        <td><?php echo $encuesta['ca_resultado'] ?></td>
                        <td><?php echo $encuesta['ca_servicio'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php } ?>
</div>