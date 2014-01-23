<?php include_partial('pregunta/error', array('pregunta' => $pregunta)); ?>

<!--
<input name="star" type="radio" class="star"/>
<input name="star" type="radio" class="star"/>
<input name="star" type="radio" class="star"/>
<input name="star" type="radio" class="star"/>
<input name="star" type="radio" class="star"/>-->

<table class="escala" border="0" cellspacing="0" cellpadding="5">
    <tbody>
        <tr>
            <td class="escala-numeros">
            </td>
            <? //php $tam_rango = ($pregunta->ca_intervalo_final - $pregunta->ca_intervalo_inicial) + 1; ?>
            <?php $inicial = $pregunta->ca_intervalo_inicial; ?>
            <?php $final = $pregunta->ca_intervalo_final; ?>
            <?php $i = $inicial; ?>
            <td class="escala-numeros">
                <?php for ($i; $i <= $final; $i++) { ?>
                <?php } ?>
            </td>
            <td class="escala-numeros">
            </td>
        </tr>
        <tr>
            <td class="estrella-fila escala-leftlabel"><?php echo $pregunta->ca_etiqueta_intervalo_inicial; ?></td>
            <?php $j = $inicial; ?>
            <td class="estrella-fila">
                <?php for ($j; $j <= $final; $j++) { ?>
                    <input name="en.<?php echo $pregunta->ca_id; ?>.grupo" class="star escala-radio grupo_<?php echo $pregunta->ca_id; ?>_<?php echo $j; ?>"  type="radio" id="grupo_<?php echo $pregunta->ca_id; ?>_<?php echo $j; ?>"  value="<?php echo $j; ?>" >
                <?php } ?>
            </td>
            <td class="estrella-fila escala-rightlabel"><?php echo $pregunta->ca_etiqueta_intervalo_final; ?></td>
        </tr>
    </tbody>
</table>

<textarea class="parrafo" id="en_<?php echo $pregunta->ca_id ?>"   name="en.<?php echo $pregunta->ca_id ?>.sencillo"></textarea>

<?php
$numColumnas = 5;
$numFilas = sizeof($servicios);
$anchoColumnas = 100 / ($numColumnas + 3);
?>

<table class="cuadricula" border="0" cellspacing="0" cellpadding="5">
    <tbody>
        <?php for ($i = 0; $i < $numFilas; $i++) { ?>
            <?php if ($i % 2 == 0) { ?>
                <tr class="cuadricula-fila cuadricula-fila-par">
                    <td style="width: <?php echo (2 * $anchoColumnas)+($anchoColumnas / 2); ?>%;" class="cuadricula-fila cuadricula-leftlabel"><?php echo $servicios[$i] ?>
                    </td>

                        <?php for ($j = 0; $j < $numColumnas; $j++) { ?>
                        <td style="width: <?php echo $anchoColumnas; ?>%;" class="cuadricula-fila">
                            <input type="radio" class="star" id="grupo_<?php echo $pregunta->ca_id; ?>_<?php echo $j; ?>" value="<?php echo $j ?>" name="en-<?php echo $i ?>.<?php echo $pregunta->ca_id ?>.grupo">
                        </td>
                    <?php } ?>
                    <td style="width: <?php echo $anchoColumnas / 2; ?>%;" class="cuadricula-fila cuadricula-spacer">
                    </td>
                </tr>
            <?php } ?>
            <?php if ($i % 2 == 1) { ?>
                <tr class="cuadricula-fila cuadricula-fila-impar">
                    <td style="width: <?php echo (2 * $anchoColumnas)+($anchoColumnas / 2); ?>%;" class="cuadricula-fila cuadricula-leftlabel"><?php echo $servicios[$i] ?>
                    </td>

                        <?php for ($j = 0; $j < $numColumnas; $j++) { ?>

                        <td style="width: <?php echo $anchoColumnas; ?>%;" class="cuadricula-fila">
                            <input type="radio" class="star" id="grupo_<?php echo $pregunta->ca_id; ?>_<?php echo $j; ?>" value="<?php echo $j ?>" name="en-<?php echo $i ?>.<?php echo $pregunta->ca_id ?>.grupo">
                        </td>
                    <?php } ?>
                    <td style="width: <?php echo $anchoColumnas / 2; ?>%;" class="cuadricula-fila cuadricula-spacer">
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>




