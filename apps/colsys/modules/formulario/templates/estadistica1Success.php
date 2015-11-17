<?php /*if ($sf_user->hasFlash('notice')): ?>
    <div class="flash_notice">
        <?php echo $sf_user->getFlash('notice') ?>
    </div>
<?php endif; */?>
<div class="resultado-estadistica">
    <h1>Reporte personalizado del formulario "<? echo $formulario->ca_titulo ?>"</h1>
    <br>
    <div class="clear-both">
    </div>
    <br>
    <p align="center" class="no">La consulta puede tardar unos minutos</p>
    <div class="contenido">
        <div class="contenedor-formulario">
            <form class="formulario" id="f_7" action="<? echo url_for('formulario/reporteDetallado?id=' . base64_encode($formulario->getCaId())) ?>" method="post">
                <div class="formulario-cabecera">
                    <div class="intro-formulario"><p><b>Ingrese los datos del reporte</b></p></div>
                </div>
                <div class="pregunta">
                    <label class="intro-pregunta">
                        <span class="pregunta-obligatoria">*</span>
                        <p>Seleccione la sucursal</p>    </label>
                    <label class="comentario-pregunta"></label>
                </div>
                <div id="p_10" class="campos-pregunta">
                    <div id="error_10" class="error_list">
                    </div>
                    <select id="en_10" name="sucursal" class="lista-reporte">
                        <option value="0" class="select-option">Todas</option>
                        <!--<option value="-1" class="select-option">No Asignada</option>-->
                        <? foreach ($sucursales as $sucursal): ?>
                            <option value="<? echo html_entity_decode($sucursal["ca_nombre"]) ?>" class="select-option"><? echo html_entity_decode($sucursal["ca_nombre"]) ?></option>
                        <? endforeach;
                        ?>
                        <option value="NA" class="select-option">No asignada</option>    
                    </select>
                </div>
                <div class="pregunta">
                    <label class="intro-pregunta">
                        <span class="pregunta-obligatoria">*</span>
                        <p>Seleccione el número de preguntas</p>    
                    </label>   
                    <label class="comentario-pregunta"></label>
                </div>
                <div id="p_10" class="campos-pregunta">
                    <div id="error_10" class="error_list">
                    </div>
                    <select id="en_10" name="pregunta" class="lista-reporte">
                        <option value="0" class="select-option">Todas</option>
                        <? foreach ($preguntas as $pregunta): ?>
                            <option value="<? echo $pregunta["ca_id"]; ?>" class="select-option"><? echo html_entity_decode($pregunta["ca_texto"]) ?></option>
                        <? endforeach;
                        ?>
                    </select>
                </div>  
                <div class="pregunta">
                    <label class="intro-pregunta">
                        <span class="pregunta-obligatoria">*</span>
                        <p>Seleccione el tipo de servicio</p>    </label>
                    <label class="comentario-pregunta"></label>
                </div>
                <div id="p_10" class="campos-pregunta">
                    <div id="error_10" class="error_list">
                    </div>
                    <select id="en_10" name="servicio" class="lista-reporte">
                        <option value="0" class="select-option">Todos</option>
                        <? foreach ($servicios as $servicio): ?>
                            <option value="<? echo $servicio["ca_id"]; ?>" class="select-option"><? echo html_entity_decode($servicio["ca_texto"]) ?></option>
                        <? endforeach;
                        ?>
                    </select>
                </div>  
                <div class="submitForm">
                    <input class="button-reportes" value="Enviar" type="submit">
                </div>
            </form>
        </div>
    </div>
    <div class="clear-both"></div>
</div>