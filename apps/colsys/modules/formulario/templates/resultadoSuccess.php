<div class="resultado-estadistica">
        <h1>Datos de la respuesta para el formulario</h1>

        <table border="1" class="listado">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pregunta</th>
                    <th>Resultado</th>
                    <th>Servicio</th>
                </tr>
            </thead>
            <tbody>
 <?php $i=0 ?>
<?php foreach ($formulario->getResultados($id) as $resultado): ?>
            <tr>
                <td><?php echo $resultado['ca_id'] ?></td><?php $pregunta= $formulario->getPregunta($resultado['ca_idpregunta'])?>
                <td><?php echo html_entity_decode($pregunta->ca_texto) ?></td>
                <td><?php echo $resultado['ca_resultado']?></td>
                <td><?php echo $formulario->getServicio($resultado['ca_servicio']) ?></td>
            </tr>
<?php endforeach; ?>

        </tbody>
    </table>

</div>
