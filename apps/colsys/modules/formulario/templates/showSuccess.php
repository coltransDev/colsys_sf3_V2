<script type="text/javascript" >
    function volver(){
<?
$url = "formulario/edit?ca_id=" . $formulario->getCaId();
?>
        document.location = "<?= $url ?>";
    }


</script>



<h1>Detalles Formulario: <?php echo $formulario->getCaTitulo() ?></h1>
<table>
    <tbody>
        <tr>
            <th>Id</th>
            <td><?php echo $formulario->getCaId() ?></td>
        </tr>
        <tr>
            <th>Titulo</th>
            <td><?php echo $formulario->getCaTitulo() ?></td>
        </tr>
        <tr>
            <th>Introducci&oacute;n</th>
            <td><?php echo html_entity_decode($formulario->getCaIntroduccion()) ?></td>
        </tr>
        <tr>
            <th>Vigencia Inical</th>
            <td><?php echo substr($formulario->getCaVigenciaInicial(), 0, 10) ?></td>
        </tr>
        <tr>
            <th>Vigencia Final</th>
            <td><?php echo substr($formulario->getCaVigenciaFinal(), 0, 10) ?></td>
        </tr>
        <tr>
        </tr>
    </tbody>
</table>


<h3 class="subcontent" title="Los bloques se listan por dos criterios: su tipo y orden. Por lo tanto los bloques tipo servicio siempre se encuentran al inicio">Bloques de preguntas en el Formulario</h3>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Tipo</th>
            <th>Nombre</th>
            <th>Introducci&oacute;n</th>
            <th>No preguntas</th>
            <th>Orden</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($formulario->getBloquesOrdenados($formulario->ca_id) as $bloque): ?>
            <tr>
                <td><a target="_BLANK" href="<?php echo url_for('bloque/show?ca_id=' . $bloque->getCaId()) ?>"><?php echo $bloque->getCaId() ?></a></td>
                <td><?php echo $bloque->getTipoBloque($bloque->getCaTipo()) ?></td>
                <td><?php echo $bloque->getCaTitulo() ?></td>
                <td><?php echo html_entity_decode($bloque->getCaIntroduccion()) ?></td>
                <td><?php echo sizeof($bloque->getTbPreguntas()) ?></td>
                <td><?php echo $bloque->getCaOrden() ?></td>
                <td>
                    <a class="" href="<?php echo url_for('bloque/show?ca_id=' . $bloque->getCaId()) ?>"><img title="Ver Detalle" alt="Ver Detalle" src="/images/formularios/detalle.png"></a>
                    <a class="" href="<?php echo url_for('bloque/edit?ca_id=' . $bloque->getCaId()) ?>"><img title="Editar" alt="Editar" src="/images/formularios/edit.gif"></a>
                    <a class="" target="_blank" href="<?php echo url_for('bloque/vistaPrevia?ca_id=' . $bloque->getCaId()) ?>"><img title="Previsualizar" title="Previsualizar" src="/images/formularios/verx16.png"></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<!--
<hr />

<a class="accion" href="<?php echo url_for('formulario/edit?ca_id=' . $formulario->getCaId()) ?>"><img src="/images/formularios/edit.gif"> Editar Formulario</a>
&nbsp;
<a class="accion" href="<?php echo url_for('formulario/index') ?>"><img src="/images/formularios/list.png"> Listar</a>
&nbsp;
<a target="_BLANK" class="accion" href="<?php echo url_for('formulario/vistaPrevia?ca_id=' . $formulario->getCaId()) ?>"><img src="/images/formularios/ver.png"> Vista Previa</a>
&nbsp;
<a target="_BLANK" class="accion" href="<? //php echo url_for('bloque/copy?ca_id='.$formulario->getCaId())     ?>"><img src="/images/formularios/add.gif"> Duplicar Formulario</a>
&nbsp;
<a target="_BLANK" class="accion" href="<?php echo url_for('bloque/nuevo?ca_id=' . $formulario->getCaId()) ?>"><img src="/images/formularios/add.gif"> Agregar Bloque</a>
-->

