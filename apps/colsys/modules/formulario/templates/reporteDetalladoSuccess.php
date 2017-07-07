<?php if ($sf_user->hasFlash('notice')): ?>
    <div class="flash_notice">
        <?php echo $sf_user->getFlash('notice') ?>
    </div>
<?php endif; ?>

<div class="resultado-estadistica">
    <h1>Reporte detallado formulario "<? echo $formulario->ca_titulo ?>"</h1>
    <br>
    <h3>Mails enviados</h3>
    <table border="1" class="listado">
        <thead>
            <tr>
                <th>Sucursal</th>
                <th>No de empresas a las que se les envio la encuesta</th>
                <th>No total de encuestas enviadas</th>
                <th>No de empresas que respondieron la encuesta</th>
                <th>No total de encuestas diligenciadas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?
            //include_partial('formulario/filaTablaEnviosReporteDetallado', array('encuestas'=>$encuestas_enviadas,'sucursal' => "0", 'formulario' => $formulario, 'p_pregunta' => $p_pregunta, 'p_servicio' => $p_servicio, 'pregunta' => $pregunta, 'servicio' => $servicio));
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
        </tbody>
    </table>
    <br>
    <br>
    <h3>Calificación por sucursal</h3>
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
        <thead>
            <tr>
                <th>Sucursal</th>
                <th>Pregunta (id : texto)</th>
                <th>Servicio</th>
                <th>Num Encuestas</th>
                <th>Num Preguntas</th>
                <th>Promedio de calificación por pregunta (1-5)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table>
    <br>
    <br>
    <h3>Calificación por servicio</h3>
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
        <thead>
            <tr>
                <th>Sucursal</th>
                <th>Pregunta (id : texto)</th>
                <th>Servicio</th>
                <th>Num Encuestas</th>
                <th>Num Preguntas</th>
                <th>Promedio de calificación por pregunta (1-5)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?
            include_partial('formulario/filaTablaPromedioServicioReporteDetallado', array('sucursal' => $p_sucursal, 'formulario' => $formulario, 'p_pregunta' => $p_pregunta, 'p_servicio' => '0', 'pregunta' => $pregunta, 'servicio' => null));
            if ($p_servicio == '0') {
                foreach ($formulario->getListaServicios() as $lservicio):
                    //crear objeto de tipo opcion
                     $opcion = $servicio;
                     $opcion = Doctrine_Core::getTable('opcion')->find($lservicio['ca_id']);
                    //if (sizeof($formulario->getListaContactosRespuesta($sucursal["ca_nombre"]))) {
                        include_partial('formulario/filaTablaPromedioServicioReporteDetallado', array('sucursal' => $p_sucursal, 'formulario' => $formulario, 'p_pregunta' => $p_pregunta, 'p_servicio' => $lservicio['ca_id'], 'pregunta' => $pregunta, 'servicio' => $opcion));
                   // }
                endforeach;

            } else {
                include_partial('formulario/filaTablaPromedioServicioReporteDetallado', array('sucursal' => $p_sucursal, 'formulario' => $formulario, 'p_pregunta' => $p_pregunta, 'p_servicio' => $p_servicio, 'pregunta' => $pregunta, 'servicio' => $servicio));
            }
            ?>
        </tbody>
    </table>
    <br>
    <br>
    <h3>Calificación por pregunta</h3>
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
        <thead>
            <tr>
                <th>Sucursal</th>
                <th>Pregunta (id : texto)</th>
                <th>Servicio</th>
                <th>Num Encuestas</th>
                <th>Num Preguntas</th>
                <th>Promedio de calificación por pregunta (1-5)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?
            include_partial('formulario/filaTablaPromedioPreguntaReporteDetallado', array('sucursal' => $p_sucursal, 'formulario' => $formulario, 'p_pregunta' => $p_pregunta, 'p_servicio' => $p_servicio, 'pregunta' => '0', 'servicio' => $servicio));
            if ($p_pregunta == '0') {
              foreach ($formulario->getListaPreguntas() as $lpregunta):
                     //crear objeto de tipo pregunta
                    $pregunta  = Doctrine_Core::getTable('pregunta')->find($lpregunta['ca_id']);    
                    include_partial('formulario/filaTablaPromedioPreguntaReporteDetallado', array('sucursal' => $p_sucursal, 'formulario' => $formulario, 'p_pregunta' => $lpregunta['ca_id'], 'p_servicio' => $p_servicio, 'pregunta' => $pregunta, 'servicio' => $servicio));
                endforeach;
                /*if (sizeof($formulario->getListaContactosRespuesta("NA")) > 0) {
                    include_partial('formulario/filaTablaPromedioReporteDetallado', array('sucursal' => "NA", 'formulario' => $formulario, 'p_pregunta' => $p_pregunta, 'p_servicio' => $p_servicio, 'pregunta' => $pregunta, 'servicio' => $servicio));
                }*/
            } else {
            include_partial('formulario/filaTablaPromedioPreguntaReporteDetallado', array('sucursal' => $p_sucursal, 'formulario' => $formulario, 'p_pregunta' => $p_pregunta, 'p_servicio' => $p_servicio, 'pregunta' => $pregunta, 'servicio' => $servicio));
            }
            ?>
        </tbody>
    </table>
    <br>
    <br>
    
    <? $z = 0 ?>
    <? if (sizeof($contactos) > 0) { ?>
        <br>
        <br>
        <h3>Consolidado de comentarios</h3>
        <table border="1" class="listado">
            <thead>
                <tr>
                    <!--<th>No</th>-->
                    <th>Id Respuesta</th>
                    <!--<th>Id Contacto</th>-->
                    <th>Compañía</th>
                    <th>Nombre Contacto </th>
                    <th>Fecha Respuesta</th>
                    <th>Pregunta</th>
                    <th>Respuesta</th>
                    <th>Servicio</th>
                    <th>Sucursal</th>
                </tr>
            </thead>
            <tbody>
                <? $i = 0 ?>
                <? foreach ($c_encuestas as $encuesta): ?>
                    <? $i++; ?>
                    <tr>
                        <!--<td><?// echo $i ?></td>-->
                        <td><? echo $encuesta['ca_id'] ?></td>
                        <!--<td><?// echo $encuesta['ca_idcontacto'] ?></td>-->
                        <td><? echo $encuesta['ca_compania'] ?></td>
                        <td><? echo $encuesta['ca_nombres'] . ' ' . $encuesta['ca_papellido'] . ' ' . $encuesta['ca_sapellido'] ?></td>
                        <td><? echo $encuesta['ca_fchcreado'] ?></td>
                        <td><? echo html_entity_decode($encuesta['ca_texto']) ?></td>
                        <td><? echo $encuesta['ca_resultado'] ?></td>
                        <td><? echo $encuesta['ca_servicio'] ?></td>
                        <td><? if($encuesta['ca_ciudad']=='')
                            { echo 'No Asignada';}
                            else
                            { echo $encuesta['ca_ciudad'];} 
                            ?>
                        </td>
                    </tr>
                <? endforeach; ?>
            </tbody>
        </table>
    <? } ?>

</div>