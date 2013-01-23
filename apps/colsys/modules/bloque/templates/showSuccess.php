<h1>Detalles Bloque: <?php echo $bloque->getCaTitulo() ?></h1>
<table>
    <tbody>
        <tr>
            <th>Id:</th>
            <td><?php echo $bloque->getCaId() ?></td>
        </tr>
        <tr>
            <th>Formulario:</th>
            <td><?php echo $bloque->getFormulario()->ca_titulo ?></td>
        </tr>
        <tr>
            <th>Titulo:</th>
            <td><?php echo $bloque->getCaTitulo() ?></td>
        </tr>
        <tr>
            <th>Introduccion:</th>
            <td><?php echo html_entity_decode($bloque->getCaIntroduccion()) ?></td>
        </tr>
        <tr>
            <th>Activo:</th>
            <td><?php echo $bloque->getTextoBooleano($bloque->ca_activo) ?>
            </td>
        </tr>
        <tr>
            <th>No de preguntas:</th>
            <td><?php echo sizeof($bloque->getTbPreguntas()); ?>
            </td>
        </tr>
        <tr>
            <th>Tipo:</th>
            <td><?php echo $bloque->getTipoBloque($bloque->ca_tipo); ?>
            </td>
        </tr>

    </tbody>
</table>
<h3 class="subcontent">Preguntas en el Bloque</h3>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Texto</th>
            <th>Obligatoria</th>
            <th>Activa</th>
            <th>Orden</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bloque->getPreguntasOrdenadas($bloque->ca_id) as $pregunta): ?>
            <tr>
                <td><a target="_BLANK" href="<?php echo url_for('pregunta/show?ca_id=' . $pregunta->getCaId()) ?>"><?php echo $pregunta->getCaId() ?></a></td>
                <td><?php echo html_entity_decode($pregunta->getCaTexto()) ?></td>
                <td><?php echo html_entity_decode($pregunta->getTextoBooleano($pregunta->getCaObligatoria())) ?></td>
                <td><?php echo html_entity_decode($pregunta->getTextoBooleano($pregunta->getCaActivo())) ?></td>
                <td><?php echo $pregunta->getCaOrden() ?></td>
                <td>
                    <a class="" href="<?php echo url_for('pregunta/show?ca_id=' . $pregunta->getCaId()) ?>"><img title="Ver Detalle" alt="Ver Detalle" src="/images/formularios/detalle.png"></a>
                    <a class="" href="<?php echo url_for('pregunta/edit?ca_id=' . $pregunta->getCaId()) ?>"><img title="Editar" alt="Editar" src="/images/formularios/edit.gif"></a>
                    <a class="" target="_blank" href="<?php echo url_for('pregunta/vistaPrevia?ca_id=' . $pregunta->getCaId()) ?>"><img title="Previsualizar" title="Previsualizar" src="/images/formularios/verx16.png"></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!--
<hr />
<a target="_BLANK" class="accion" href="<?php echo url_for('pregunta/nuevo?ca_id=' . $bloque->getCaId()) ?>"><img src="/images/formularios/add.gif"> Agregar Pregunta</a>-->