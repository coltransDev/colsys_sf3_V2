<h1>Detalles Bloque: <? echo $bloque->getCaTitulo() ?></h1>
<table>
    <tbody>
        <tr>
            <th>Id:</th>
            <td><? echo $bloque->getCaId() ?></td>
        </tr>
        <tr>
            <th>Formulario:</th>
            <td><? echo $bloque->getFormulario()->ca_titulo ?></td>
        </tr>
        <tr>
            <th>Titulo:</th>
            <td><? echo $bloque->getCaTitulo() ?></td>
        </tr>
        <tr>
            <th>Introduccion:</th>
            <td><? echo html_entity_decode($bloque->getCaIntroduccion()) ?></td>
        </tr>
        <tr>
            <th>Activo:</th>
            <td><? echo $bloque->getTextoBooleano($bloque->ca_activo) ?>
            </td>
        </tr>
        <tr>
            <th>No de preguntas:</th>
            <td><? echo sizeof($bloque->getTbPreguntas()); ?>
            </td>
        </tr>
        <tr>
            <th>Tipo:</th>
            <td><? echo $bloque->getTipoBloque($bloque->ca_tipo); ?>
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
        <? foreach ($bloque->getTodasPreguntasOrdenadas($bloque->ca_id) as $pregunta): ?>
            <tr>
                <td><a target="_BLANK" href="<? echo url_for('pregunta/show?ca_id=' . $pregunta->getCaId()) ?>"><? echo $pregunta->getCaId() ?></a></td>
                <td><? echo html_entity_decode($pregunta->getCaTexto()) ?></td>
                <td><? echo html_entity_decode($pregunta->getTextoBooleano($pregunta->getCaObligatoria())) ?></td>
                <td><? echo html_entity_decode($pregunta->getTextoBooleano($pregunta->getCaActivo())) ?></td>
                <td><? echo $pregunta->getCaOrden() ?></td>
                <td>
                    <a class="" href="<? echo url_for('pregunta/show?ca_id=' . $pregunta->getCaId()) ?>"><img title="Ver Detalle" alt="Ver Detalle" src="/images/formularios/detalle.png"></a>
                    <? if($nivel<=1) {?>
                    <a class="" href="<? echo url_for('pregunta/edit?ca_id=' . $pregunta->getCaId()) ?>"><img title="Editar" alt="Editar" src="/images/formularios/edit.gif"></a>
                    <? } ?>
                    <a class="" target="_blank" href="<? echo url_for('pregunta/vistaPrevia?ca_id=' . $pregunta->getCaId()) ?>"><img title="Previsualizar" title="Previsualizar" src="/images/formularios/verx16.png"></a>
                </td>
            </tr>
        <? endforeach; ?>
    </tbody>
</table>
<!--
<hr />
<a target="_BLANK" class="accion" href="<? echo url_for('pregunta/nuevo?ca_id=' . $bloque->getCaId()) ?>"><img src="/images/formularios/add.gif"> Agregar Pregunta</a>-->