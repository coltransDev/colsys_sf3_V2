<div class="pregunta">
    <label class="intro-pregunta">
        <?php if ($pregunta->ca_obligatoria == 'true') { ?>
            <span class="pregunta-obligatoria">*</span>
            <?php echo html_entity_decode($pregunta->ca_texto) ?>
        <?php } else { ?>
            <?php echo html_entity_decode($pregunta->ca_texto) ?>
        <?php } ?>
    </label>
    <label class="comentario-pregunta"><?php echo html_entity_decode($pregunta->ca_ayuda); ?></label>
</div>
<div class="campos-pregunta">
    <!-- número -->
    <?php
    if ($pregunta->ca_tipo == 0) {
        include_partial('pregunta/pNumero', array('pregunta' => $pregunta));
    }
    ?>
    <!-- texto -->
<?php if ($pregunta->ca_tipo == 1) { ?>

        <input class="texto" type="text" id="entrada_<?php echo $pregunta->ca_id ?>"  value="" name="entrada.<?php echo $pregunta->ca_id ?>.sencillo">
        <!-- parrafo -->
<?php } elseif ($pregunta->ca_tipo == 1) { ?>
        <textarea class="parrafo" id="entrada_<?php echo $pregunta->ca_id ?>"   name="entrada.<?php echo $pregunta->ca_id ?>.sencillo"></textarea>
        <!-- test -->
        <?php } elseif ($pregunta->ca_tipo == 2) { ?>
        <ul class="test">
            <?php $cont = 1; ?>
    <?php foreach ($pregunta->getTbOpcions() as $opcion): ?>
                <li class="radio-item">
                    <label class="radio-label">
                        <input type="radio" id="grupo_<?php echo $pregunta->ca_id ?>_<?php echo $cont ?>" class="radio-button" value="<?php echo html_entity_decode($opcion->ca_texto) ?>" name="entrada.<?php echo $pregunta->ca_id ?>.grupo">
        <?php echo html_entity_decode($opcion->ca_texto) ?>
                    </label>
                </li>
                <?php $cont++; ?>
    <?php endforeach; ?>
        </ul>
        <!-- casillas de verificacion -->
        <?php } elseif ($pregunta->ca_tipo == 3) { ?>
        <ul class="seleccion_multiple">
            <?php $cont = 1; ?>
    <?php foreach ($pregunta->getTbOpcions() as $opcion): ?>
                <li class="box-item">
                    <label class="box-label">
                        <input type="checkbox" id="grupo_<?php echo $pregunta->ca_id ?>_<?php echo $cont ?>" class="checkbox" value="<?php echo html_entity_decode($opcion->ca_texto) ?>" name="entrada.<?php echo $pregunta->ca_id ?>.grupo">
        <?php echo html_entity_decode($opcion->ca_texto) ?>
                    </label>
                </li>
                <?php $cont++; ?>
    <?php endforeach; ?>
        </ul>
        <!-- lista desplegable -->
        <?php } elseif ($pregunta->ca_tipo == 4) { ?>
        <select class="lista-desplegable" name="entrada.<?php echo $pregunta->ca_id ?>.sencillo" id="entrada_<?php echo $pregunta->ca_id ?>">
            <?php foreach ($pregunta->getTbOpcions() as $opcion): ?>
                <option class="select-option" value="<?php echo html_entity_decode($opcion->ca_texto) ?>"><?php echo html_entity_decode($opcion->ca_texto) ?></option>
    <?php endforeach; ?>
        </select>
        <!-- escala, necesita intervalo inicial y final y etiquetas para ambos intervalos -->
<?php } elseif ($pregunta->ca_tipo == 5) { ?>
        <table class="escala" border="0" cellspacing="0" cellpadding="5">
            <tbody>
                <tr>
                    <td class="escala-numeros">
                    </td>
                    <?php $tam_rango = ($pregunta->ca_intervalo_final - $pregunta->ca_intervalo_inicial) + 1; ?>
                    <?php $inicial = $pregunta->ca_intervalo_inicial; ?>
                    <?php $final = $pregunta->ca_intervalo_final; ?>
                    <?php $i = $inicial; ?>
    <?php for ($i; $i <= $final; $i++) { ?>
                        <td class="escala-numeros">
                            <label for="grupo_<?php echo $pregunta->ca_id; ?>_<?php echo $i; ?>" class="escala-numero"> <?php echo $i; ?></label>
                        </td>
    <?php } ?>
                    <td class="escala-numeros">
                    </td>
                </tr>
                <tr>
                    <td class="escala-fila escala-leftlabel"><?php echo $pregunta->ca_etiqueta_intervalo_inicial; ?></td>
                    <?php $j = $inicial; ?>
    <?php for ($j; $j <= $final; $j++) { ?>
                        <td class="escala-fila">
                            <input type="radio" id="grupo_<?php echo $pregunta->ca_id; ?>_<?php echo $j; ?>" class="escala-radio" value="<?php echo $j; ?>" name="entrada.<?php echo $pregunta->ca_id; ?>.grupo">
                        </td>
    <?php } ?>
                    <td class="escala-fila escala-rightlabel"><?php echo $pregunta->ca_etiqueta_intervalo_final; ?></td>
                </tr>
            </tbody>
        </table>
    <?php } else { ?>
        <!-- cuadricula, necesita un numero de columnas, y un listado de etiquetas por fila y columna (separados por coma) -->
        <?php
        $labelsColumnas = explode(",", $pregunta->ca_etiquetas_columnas);
        $labelsFilas = explode(",", $pregunta->ca_etiquetas_filas);
        $numColumnas = sizeof($labelsColumnas);
        $numFilas = sizeof($labelsFilas);
        $anchoColumnas = 100 / ($numColumnas + 3);
        ?>


        <table class="cuadricula" border="0" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <td style="width: <?php echo 2 * $anchoColumnas; ?>%;" class="cuadricula-numeros">
                    </td>
                    <td style="width: <?php echo $anchoColumnas / 2; ?>%;" class="cuadricula-numeros">
                    </td>
    <?php for ($i = 0; $i < $numColumnas; $i++) { ?>
                        <td style="width: <?php echo $anchoColumnas; ?>%;" class="cuadricula-numeros">
                            <label class="cuadricula-numero"><?php echo trim($labelsColumnas[$i]) ?></label>
                        </td>
    <?php } ?>
                    <td style="width: <?php echo $anchoColumnas / 2; ?>%;" class="cuadricula-numeros">
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < $numFilas; $i++) { ?>
        <?php if ($i % 2 == 0) { ?>
                        <tr class="cuadricula-fila cuadricula-fila-par">
                            <td style="width: <?php echo 2 * $anchoColumnas; ?>%;" class="cuadricula-fila cuadricula-leftlabel"><?php echo trim($labelsFilas[$i]) ?>
                            </td>
                            <td style="width: <?php echo $anchoColumnas / 2; ?>%;" class="cuadricula-fila cuadricula-spacer">
            <?php for ($j = 0; $j < $numColumnas; $j++) { ?>
                                <td style="width: <?php echo $anchoColumnas; ?>%;" class="cuadricula-fila">
                                    <input type="radio" id="grupo_<?php echo $pregunta->ca_id; ?>_<?php echo $j; ?>" value="<?php echo $labelsColumnas[$j] ?>" name="entrada.<?php echo $pregunta->ca_id ?>-<?php echo $i ?>.grupo">
                                </td>
            <?php } ?>
                            <td style="width: <?php echo $anchoColumnas / 2; ?>%;" class="cuadricula-fila cuadricula-spacer">
                            </td>
                        </tr>
                    <?php } ?>
        <?php if ($i % 2 == 1) { ?>
                        <tr class="cuadricula-fila cuadricula-fila-impar">
                            <td style="width: <?php echo 2 * $anchoColumnas; ?>%;" class="cuadricula-fila cuadricula-leftlabel"><?php echo trim($labelsFilas[$i]) ?>
                            </td>
                            <td style="width: <?php echo $anchoColumnas / 2; ?>%;" class="cuadricula-fila cuadricula-spacer">
            <?php for ($j = 0; $j < $numColumnas; $j++) { ?>

                                <td style="width: <?php echo $anchoColumnas; ?>%;" class="cuadricula-fila">
                                    <input type="radio" id="grupo_<?php echo $pregunta->ca_id; ?>_<?php echo $j; ?>" value="<?php echo $labelsColumnas[$j] ?>" name="entrada.<?php echo $pregunta->ca_id ?>.grupo">
                                </td>
            <?php } ?>
                            <td style="width: <?php echo $anchoColumnas / 2; ?>%;" class="cuadricula-fila cuadricula-spacer">
                            </td>
                        </tr>
                    <?php } ?>

    <?php } ?>


            </tbody>
        </table>
<?php } ?>
</div>
