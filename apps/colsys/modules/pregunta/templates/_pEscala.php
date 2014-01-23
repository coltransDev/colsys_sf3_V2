<?php include_partial('pregunta/error', array('pregunta' => $pregunta)); ?>
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
                    <input class="radio-button grupo" type="radio" id="grupo_<?php echo $pregunta->ca_id; ?>_<?php echo $j; ?>" class="escala-radio" value="<?php echo $j; ?>" name="en.<?php echo $pregunta->ca_id; ?>.grupo">
                </td>
            <?php } ?>
            <td class="escala-fila escala-rightlabel"><?php echo $pregunta->ca_etiqueta_intervalo_final; ?></td>
        </tr>
    </tbody>
</table>



















