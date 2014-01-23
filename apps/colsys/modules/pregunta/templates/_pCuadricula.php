<?php
$labelsColumnas = explode(",", $pregunta->ca_etiquetas_columnas);
$labelsFilas = explode(",", $pregunta->ca_etiquetas_filas);
$numColumnas = sizeof($labelsColumnas);
$numFilas = sizeof($labelsFilas);
$anchoColumnas = 100 / ($numColumnas + 3);
?>

<?php include_partial('pregunta/error', array('pregunta' => $pregunta)); ?>
<table class="cuadricula" border="0" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <td style="width: <?php echo (2 * $anchoColumnas)+($anchoColumnas / 2); ?>%;" class="cuadricula-numeros">
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
                    <td style="width: <?php echo (2 * $anchoColumnas)+($anchoColumnas / 2); ?>%;" class="cuadricula-fila cuadricula-leftlabel"><?php echo trim($labelsFilas[$i]) ?>
                    </td>

                        <?php for ($j = 0; $j < $numColumnas; $j++) { ?>
                        <td style="width: <?php echo $anchoColumnas; ?>%;" class="cuadricula-fila">
                            <input type="radio" id="grupo_<?php echo $pregunta->ca_id; ?>_<?php echo $j; ?>" value="<?php echo $labelsColumnas[$j] ?>" name="en-<?php echo $i ?>.<?php echo $pregunta->ca_id ?>.grupo">
                        </td>
                    <?php }
                    if ($device == 'desktop') { ?>
                    <td style="width: <?php echo $anchoColumnas / 2; ?>%;" class="cuadricula-fila cuadricula-spacer">
                    </td
                    <?php } ?>
                </tr>
            <?php } ?>
            <?php if ($i % 2 == 1) { ?>
                <tr class="cuadricula-fila cuadricula-fila-impar">
                    <td style="width: <?php echo (2 * $anchoColumnas)+($anchoColumnas / 2); ?>%;" class="cuadricula-fila cuadricula-leftlabel"><?php echo trim($labelsFilas[$i]) ?>
                    </td>

                        <?php for ($j = 0; $j < $numColumnas; $j++) { ?>

                        <td style="width: <?php echo $anchoColumnas; ?>%;" class="cuadricula-fila">
                            <input type="radio" id="grupo_<?php echo $pregunta->ca_id; ?>_<?php echo $j; ?>" value="<?php echo $labelsColumnas[$j] ?>" name="en-<?php echo $i ?>.<?php echo $pregunta->ca_id ?>.grupo">
                        </td>
                    <?php }  if ($device == 'desktop') { ?>?>
                    <td style="width: <?php echo $anchoColumnas / 2; ?>%;" class="cuadricula-fila cuadricula-spacer">
                    </td
                    <?php } ?>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>