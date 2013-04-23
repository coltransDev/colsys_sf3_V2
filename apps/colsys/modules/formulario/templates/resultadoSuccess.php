<div class="resultado-estadistica">
    <h1>Datos de la respuesta al formulario <? echo $control->getFormulario()->ca_alias ?></h1>
    <br>
    <table border="1" class="listado">
        <thead>
            <tr>
                <th>Id Respuesta</th>
                <th>Compañía</th>
                <th>Sucursal</th>
                <th>Nombre Contacto </th>
                <th>Email Contacto</th>
                <th>R. ventas</th>
                <th>Fecha Respuesta</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><? echo $respuestas[0]['ca_id'] ?></td>
                <td><? echo $respuestas[0]['empresa'] ?></td>
                <td><? echo $respuestas[0]['ca_sucursal'] ?></td>
                <td><? echo $respuestas[0]['ca_nombres'] . ' ' . $respuestas[0]['ca_papellido'] . ' ' . $respuestas[0]['ca_sapellido'] ?></td>
                <td><? echo $respuestas[0]['ca_email'] ?></td>
                <td><? echo $respuestas[0]['ca_vendedor'] ?></td>
                <td><? echo $respuestas[0]['ca_fchcreado'] ?></td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>

    <table border="1" class="listado">
        <thead>
            <tr>
                <th>Pregunta</th>
                <th>Respuesta</th>
                <th>Servicio</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0 ?>
            <?php foreach ($respuestas as $resultado): ?>
                <tr>
                    <td><?php echo html_entity_decode($resultado['ca_pregunta']) ?></td>
                    <td><?php echo $resultado['ca_resultado'] ?></td>
                    <td><?php echo $resultado['ca_servicio'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</div>
