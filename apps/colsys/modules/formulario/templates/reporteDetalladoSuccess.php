<?php if ($sf_user->hasFlash('notice')): ?>
    <div class="flash_notice">
        <?php echo $sf_user->getFlash('notice') ?>
    </div>
<?php endif; ?>

<div class="resultado-estadistica">
    <h1>REPORTE CONSOLIDADO</h1><br/>
    <h1><?=strtoupper($formulario->ca_titulo)?></h1>
    <br/>
    <h3>ENCUESTAS</h3><br/>
    <table border="1" class="box1">
        <tr>
            <th>Sucursal</th>
            <th style="text-align: center; width: 110px;">Cantidad de empresas a las que se envió la encuesta</th>
            <th style="text-align: center; width: 110px;">Cantidad de contactos a los que se envió la encuesta</th>
            <th style="text-align: center; width: 110px;">Cantidad de empresas que respondieron la encuesta</th>
            <th style="text-align: center; width: 50px;">Detalles</th>
        </tr>

        <?
        include_partial('formulario/filaTablaEnviosReporteDetallado', array('encuestas' => $encuestas_enviadas, 'lista_empresas' => $lista_empresas_enviadas,'lista_encuestas' => $lista_encuestas_enviadas, 'encuestas_unicas'=>$encuestas_unicas_enviadas,'formulario' => $formulario, 'servicio' => $servicio, 'sucursal' => "0", 'p_pregunta' => $p_pregunta));
        if ($p_sucursal == '0') {
            foreach ($formulario->getListaSucursales() as $sucursal):
                if (sizeof($formulario->getListaContactosRespuesta($sucursal["ca_nombre"]))) {
                    include_partial('formulario/filaTablaEnviosReporteDetallado', array('encuestas' => $encuestas_enviadas, 'lista_empresas' => $lista_empresas_enviadas,'lista_encuestas' => $lista_encuestas_enviadas, 'encuestas_unicas'=>$encuestas_unicas_enviadas, 'formulario' => $formulario, 'servicio' => $servicio, 'sucursal' => $sucursal["ca_nombre"],'p_pregunta' => $p_pregunta));
                }
            endforeach;
            if (sizeof($formulario->getListaContactosRespuesta("NA")) > 0) {
                include_partial('formulario/filaTablaEnviosReporteDetallado', array('encuestas' => $encuestas_enviadas, 'lista_empresas' => $lista_empresas_enviadas,'lista_encuestas' => $lista_encuestas_enviadas, 'encuestas_unicas'=>$encuestas_unicas_enviadas, 'formulario' => $formulario, 'servicio' => $servicio, 'sucursal' => "NA",'p_pregunta' => $p_pregunta));
            }
        } else {
            include_partial('formulario/filaTablaEnviosReporteDetallado', array('encuestas' => $encuestas_enviadas, 'lista_empresas' => $lista_empresas_enviadas,'lista_encuestas' => $lista_encuestas_enviadas, 'encuestas_unicas'=>$encuestas_unicas_enviadas, 'formulario' => $formulario, 'servicio' => $servicio, 'sucursal' => $p_sucursal,'p_pregunta' => $p_pregunta));
        }
        ?>
    </table><br/><br/>
    
    <h3>CALIFICACION POR SUCURSAL</h3><br/>
    <?
    $promedio_general = 0;
    foreach ($formulario->getPromedio($p_sucursal, $p_pregunta, $servicio, null) as $encuesta){
        if ($encuesta['count'] == 0) {
            $promedio_general = 'No Hay preguntas con estos críterios';
        }
        else
            $promedio_general = $encuesta['avg'];
        ?>       
    <?}?>
    <table border = "1" class = "box1">
        <tr>
            <th>Sucursal</th>
            <th style="text-align: center; width: 50px;">Preguntas</th>
            <th style="text-align: center; width: 50px;">Servicios</th>
            <th style="text-align: center; width: 110px;">Cantidad de Encuestas</th>
            <th style="text-align: center; width: 110px;">Cantidad de Preguntas</th>
            <th style="text-align: center; width: 110px;">Promedio de calificación por Sucursal</th>
            <th style="text-align: center; width: 50px;">Detalles</th>
        </tr>
        <?
        include_partial('formulario/filaTablaPromedioReporteDetallado', array('sucursal' => "0", 'formulario' => $formulario, 'p_pregunta' => $p_pregunta, 'p_servicio' => $p_servicio, 'pregunta' => $pregunta, 'servicio' => $servicio));
        if ($p_sucursal == '0') {
            foreach ($formulario->getListaSucursales() as $sucursal):
                if (sizeof($formulario->getListaContactosRespuesta($sucursal["ca_nombre"]))) {
                    include_partial('formulario/filaTablaPromedioReporteDetallado', array('sucursal' => $sucursal["ca_nombre"], 'formulario' => $formulario, 'p_pregunta' => $p_pregunta, 'p_servicio' => $p_servicio, 'pregunta' => $pregunta, 'servicio' => $servicio));
                }
            endforeach;
            if (sizeof($formulario->getListaContactosRespuesta("NA")) > 0) {
                include_partial('formulario/filaTablaPromedioReporteDetallado', array('sucursal' => "NA", 'formulario' => $formulario, 'p_pregunta' => $p_pregunta, 'p_servicio' => $p_servicio, 'pregunta' => $pregunta, 'servicio' => $servicio));
            }
        } else {
            include_partial('formulario/filaTablaPromedioReporteDetallado', array('sucursal' => $p_sucursal, 'formulario' => $formulario, 'p_pregunta' => $p_pregunta, 'p_servicio' => $p_servicio, 'pregunta' => $pregunta, 'servicio' => $servicio));
        }
        ?>
    </table><br/><br/>
    
    <h3>CALIFICACION POR SERVICIO</h3><br/>
    <?
    $promedio_general = 0;
    foreach ($formulario->getPromedio($p_sucursal, $p_pregunta, $servicio, null) as $encuesta):
        if ($encuesta['count'] == 0) {
            $promedio_general = 'No Hay preguntas con estos críterios';
        }
        else
            $promedio_general = $encuesta['avg'];
        ?>       
    <? endforeach; ?>
    <table border = "1" class = "listado">
        <tr>
            <th>Sucursal</th>
            <th style="text-align: center; width: 50px;">Preguntas</th>
            <th style="text-align: center; width: 350px;">Servicios</th>
            <th style="text-align: center; width: 80px;">Cantidad de Encuestas</th>
            <th style="text-align: center; width: 80px;">Cantidad de Preguntas</th>
            <th style="text-align: center; width: 110px;">Promedio de calificación por Servicio</th>
            <th style="text-align: center; width: 50px;">Detalles</th>
        </tr>
        <?
        include_partial('formulario/filaTablaPromedioServicioReporteDetallado', array('sucursal' => $p_sucursal, 'formulario' => $formulario, 'p_pregunta' => $p_pregunta, 'p_servicio' => '0', 'pregunta' => $pregunta, 'servicio' => null));
        if ($p_servicio == '0') {
            foreach ($formulario->getListaServicios() as $lservicio){
                $opcion = $servicio;
                $opcion = Doctrine_Core::getTable('opcion')->find($lservicio['ca_id']);
                include_partial('formulario/filaTablaPromedioServicioReporteDetallado', array('sucursal' => $p_sucursal, 'formulario' => $formulario, 'p_pregunta' => $p_pregunta, 'p_servicio' => $lservicio['ca_id'], 'pregunta' => $pregunta, 'servicio' => $opcion));
            }
        } else {
            include_partial('formulario/filaTablaPromedioServicioReporteDetallado', array('sucursal' => $p_sucursal, 'formulario' => $formulario, 'p_pregunta' => $p_pregunta, 'p_servicio' => $p_servicio, 'pregunta' => $pregunta, 'servicio' => $servicio));
        }
        ?>
    </table><br/><br/>
    
    <h3>CALIFICACION POR PREGUNTA</h3><br/>
    <?
    $promedio_general = 0;
    foreach ($formulario->getPromedio($p_sucursal, $p_pregunta, $servicio, null) as $encuesta):
        if ($encuesta['count'] == 0) {
            $promedio_general = 'No Hay preguntas con estos críterios';
        }
        else
            $promedio_general = $encuesta['avg'];
        ?>       
    <? endforeach; ?>
    <table border = "1" class = "listado">
        <tr>
            <th>Sucursal</th>
            <th style="text-align: center; width: 350px;">Preguntas</th>
            <th style="text-align: center; width: 50px;">Servicios</th>
            <th style="text-align: center; width: 80px;">Cantidad de Encuestas</th>
            <th style="text-align: center; width: 80px;">Cantidad de Preguntas</th>
            <th style="text-align: center; width: 110px;">Promedio de calificación por pregunta (1-5)</th>
            <th style="text-align: center; width: 50px;">Detalles</th>
        </tr>
        <?
        include_partial('formulario/filaTablaPromedioPreguntaReporteDetallado', array('sucursal' => $p_sucursal, 'formulario' => $formulario, 'p_pregunta' => $p_pregunta, 'p_servicio' => $p_servicio, 'pregunta' => '0', 'servicio' => $servicio));
        if ($p_pregunta == '0') {
          foreach ($formulario->getListaPreguntas() as $lpregunta){
            $pregunta  = Doctrine_Core::getTable('pregunta')->find($lpregunta['ca_id']);    
            include_partial('formulario/filaTablaPromedioPreguntaReporteDetallado', array('sucursal' => $p_sucursal, 'formulario' => $formulario, 'p_pregunta' => $lpregunta['ca_id'], 'p_servicio' => $p_servicio, 'pregunta' => $pregunta, 'servicio' => $servicio));
          }
        }else{
            include_partial('formulario/filaTablaPromedioPreguntaReporteDetallado', array('sucursal' => $p_sucursal, 'formulario' => $formulario, 'p_pregunta' => $p_pregunta, 'p_servicio' => $p_servicio, 'pregunta' => $pregunta, 'servicio' => $servicio));
        }
        ?>
    </table><br/><br/>
    
    <? $z = 0 ?>
    <? if (sizeof($contactos) > 0) { ?>
        <h3>CONSOLIDADO DE COMENTARIOS</h3><br/>
        <table border="1" class="listado">
            <tr>
                <th style="width: 320px">Compañía</th>
                <th style="width: 120px">Nombre Contacto </th>
                <th style="width: 110px">Fecha Respuesta</th>
                <th style="width: 350px">Respuesta</th>
            </tr>
<?          $i = 0;
            $lastCompania = "";
            $lastSucursal = "";
            /*foreach ($c_encuestas as $encuesta){
                if($lastPregunta != html_entity_decode($encuesta['ca_texto'])){
                    $lastPregunta = html_entity_decode($encuesta['ca_texto']);
                ?>
                    <tr>
                        <td colspan="6" style="text-align: left; color: blue; font-size:20px;">
                            &nbsp;<?=$lastPregunta?>
                        </td>
                    </tr>
                <?
                }
                if( $lastSucursal!=$encuesta['ca_ciudad'] ){
                    $lastSucursal=$encuesta['ca_ciudad'];
                ?>
                    <tr>
                        <td style="color: #062A7D;" colspan="6">
                            &nbsp;&nbsp;<?=$lastSucursal?>
                        </td>
                    </tr>
                <?
                }
                ?>
                <tr>
                    <td> &nbsp;&nbsp;&nbsp;<?=$encuesta['ca_compania'] ?></td>
                    <td><?=$encuesta['ca_nombres'] . ' ' . $encuesta['ca_papellido']?></td>
                    <td><?=$encuesta['ca_fchcreado'] ?></td>
                    <td><?=$encuesta['ca_resultado'] ?></td>
                </tr>
            <?}?>*/
            foreach ($c_encuestas as $encuesta){
                if( $lastSucursal!=$encuesta['ca_ciudad'] ){
                    $lastSucursal=$encuesta['ca_ciudad'];
                ?>
                    <tr>
                        <td style="text-align: left; color: blue; font-size:20px;"  colspan="6">
                            <?=$lastSucursal?>
                        </td>
                    </tr>
                <?
                }
                if($lastCompania != $encuesta['ca_compania']){
                    $lastCompania = $encuesta['ca_compania'];
                ?>
                    <tr>
                        <td colspan="6" style="color: #062A7D; font-size:18px;" >
                            &nbsp;<?=$lastCompania."-".$encuesta['ca_nombrevendedor']?>
                        </td>
                    </tr>
                <?
                }
                ?>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;<?=html_entity_decode($encuesta['ca_texto'])?></td>
                    <td><?=$encuesta['ca_nombres'] . ' ' . $encuesta['ca_papellido']?></td>
                    <td><?=$encuesta['ca_fchcreado'] ?></td>
                    <td><?=$encuesta['ca_resultado'] ?></td>
                </tr>
            <?}?>
        </table>
    <? } ?>
</div>