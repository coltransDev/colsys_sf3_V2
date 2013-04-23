<script type="text/javascript" >
    function volver(){
<?
$url = "formulario/edit?ca_id=" . $formulario->getCaId();
?>
        document.location = "<?= $url ?>";
    }


</script>



<h1>Detalles Formulario: <? echo $formulario->getCaTitulo() ?></h1>
<table>
    <tbody>
        <tr>
            <th>Id</th>
            <td><? echo $formulario->getCaId() ?></td>
        </tr>
        <tr>
            <th>Titulo</th>
            <td><? echo $formulario->getCaTitulo() ?></td>
        </tr>
        <tr>
            <th>Introducci&oacute;n</th>
            <td><? echo html_entity_decode($formulario->getCaIntroduccion()) ?></td>
        </tr>
                <tr>
            <th>Empresa</th>
            <td><? echo html_entity_decode($formulario->getCaEmpresa()) ?></td>
        </tr>
      <!--  <tr>
            <th>Vigencia Inical</th>
            <td><? // echo substr($formulario->getCaVigenciaInicial(), 0, 10)   ?></td>
        </tr>
        <tr>
            <th>Vigencia Final</th>
            <td><? // echo substr($formulario->getCaVigenciaFinal(), 0, 10)   ?></td>
        </tr> -->
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
        <? foreach ($formulario->getTodosBloquesOrdenados($formulario->ca_id) as $bloque): ?>
            <tr>
                <td><a target="_BLANK" href="<? echo url_for('bloque/show?ca_id=' . $bloque->getCaId()) ?>"><? echo $bloque->getCaId() ?></a></td>
                <td><? echo $bloque->getTipoBloque($bloque->getCaTipo()) ?></td>
                <td><? echo $bloque->getCaTitulo() ?></td>
                <td><? echo html_entity_decode($bloque->getCaIntroduccion()) ?></td>
                <td><? echo sizeof($bloque->getTbPreguntas()) ?></td>
                <td><? echo $bloque->getCaOrden() ?></td>
                <td>
                    <a class="" href="<? echo url_for('bloque/show?ca_id=' . $bloque->getCaId()) ?>"><img title="Ver Detalle" alt="Ver Detalle" src="/images/formularios/detalle.png"></a>
                    <? if ($nivel<=1){ ?>
                    <a class="" href="<? echo url_for('bloque/edit?ca_id=' . $bloque->getCaId()) ?>"><img title="Editar" alt="Editar" src="/images/formularios/edit.gif"></a>
                    <? } ?>
                    <a class="" target="_blank" href="<? echo url_for('bloque/vistaPrevia?ca_id=' . $bloque->getCaId()) ?>"><img title="Previsualizar" title="Previsualizar" src="/images/formularios/verx16.png"></a>
                    <!--<a class="" target="_blank" href="<? //echo url_for('bloque/borrarCascada?ca_id=' . $bloque->getCaId()) ?>"><img title="Borrar en cascada" title="Borrar en cascada" src="/images/formularios/verx16.png"></a>-->
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>




