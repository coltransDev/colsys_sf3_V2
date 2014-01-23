<h1>Detalle de la pregunta</h1>

<table>
    <tbody>
        <tr>
            <th><h4>DATOS GENERALES</h4></th>
<td></td>
</tr>
<tr>
    <th>Id:</th>
    <td><?php echo $pregunta->getCaId() ?></td>
</tr>
<tr>
    <th>bloque:</th>
    <td><?php echo $pregunta->getBloque()->ca_titulo ?></td>
</tr>
<tr>
    <th>texto:</th>
    <td><?php echo html_entity_decode($pregunta->getCaTexto()) ?></td>
    <!--   <td><?php // echo str_replace(\"<p></p>\",\"\",html_entity_decode($pregunta->getCaTexto()))   ?> </td>-->
</tr>
<tr>
    <th>ayuda:</th>
    <td><?php echo $pregunta->getCaAyuda() ?></td>
</tr>
<tr>
    <th>obligatoria:</th>
    <td><?php echo html_entity_decode($pregunta->getTextoBooleano($pregunta->getCaObligatoria())) ?></td>
</tr>
<tr>
    <th>tipo:</th>
    <td><?php echo $pregunta->getPreguntaTipo($pregunta->getCaTipo()) ?></td>
</tr>
<tr>
    <th>activo:</th>
    <td><?php echo html_entity_decode($pregunta->getTextoBooleano($pregunta->getCaActivo())) ?></td>
</tr>
<tr>
    <th>orden:</th>
    <td><?php echo $pregunta->getCaOrden() ?></td>
</tr>
<tr>
    <th><h4>DATOS PREGUNTAS TIPO ESCALA</h4></th>
<td></td>
</tr>
<tr>
    <th>intervalo inicial:</th>
    <td><?php echo $pregunta->getCaIntervaloInicial() ?></td>
</tr>
<tr>
    <th>intervalo final:</th>
    <td><?php echo $pregunta->getCaIntervaloFinal() ?></td>
</tr>
<tr>
    <th>etiqueta intervalo inicial:</th>
    <td><?php echo $pregunta->getCaEtiquetaIntervaloInicial() ?></td>
</tr>
<tr>
    <th>etiqueta intervalo final:</th>
    <td><?php echo $pregunta->getCaEtiquetaIntervaloFinal() ?></td>
</tr>
<tr>
    <th><h4>DATOS PREGUNTAS TIPO CUADR&Iacute;CULA</h4></th>
<td></td>
</tr>
<tr>
    <th>etiquetas columnas:</th>
    <td><?php echo $pregunta->getCaEtiquetasColumnas() ?></td>
</tr>
<tr>
    <th>etiquetas filas:</th>
    <td><?php echo $pregunta->getCaEtiquetasFilas() ?></td>
</tr>
</tbody>
</table>



<h3>Lista de Opciones</h3>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Texto</th>
            <th>Orden</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pregunta->getOpcionesOrdenadas($pregunta->ca_id) as $opcion): ?>
            <tr>
                <td><a target="_BLANK" href="<?php echo url_for('opcion/show?ca_id=' . $opcion->getCaId()) ?>"><?php echo $opcion->getCaId() ?></a></td>
                <td><?php echo $opcion->getCaTexto() ?></td>
                <td><?php echo $opcion->getCaOrden() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!--
<a target="_BLANK" class="accion" href="<? //php echo url_for('opcion/nuevo?ca_id='.$pregunta->getCaId())  ?>"><img src="/images/formularios/add.gif"> Agregar Opción</a>
<!-- -->
