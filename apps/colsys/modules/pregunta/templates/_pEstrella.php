<?php include_partial('pregunta/error', array('pregunta' => $pregunta)); ?>

<!--
<input name="star" type="radio" class="star"/>
<input name="star" type="radio" class="star"/>
<input name="star" type="radio" class="star"/>
<input name="star" type="radio" class="star"/>
<input name="star" type="radio" class="star"/>-->


<?php
$numColumnas = 5;
$numFilas = sizeof($servicios);
$anchoColumnas = 100 / ($numColumnas + 3);

/*function getServicio($servicio) {
    $cadena = trim($servicio);
    switch ($cadena) {
        case "Importaciones aéreo":
            return 1;
            break;
        case "Importaciones marítimo":
            return 2;
            break;
        case "Exportaciones aéreo":
            return 3;
            break;
        case "Exportaciones marítimo":
            return 4;
        case "Proceso de Nacionalización en embarques aéreos":
            return 5;
        case "Proceso de Nacionalización en embarques marítimos":
            return 6;
        case "Proceso de Nacionalización en embarques con OTM / DTA":
            return 7;
            break;
        default:
            return 99;
    }
}*/
?>

<table class="cuadricula" border="0" cellspacing="0" cellpadding="3">
    <tbody>
        <?php for ($i = 0; $i < $numFilas; $i++) { ?>
            <?php if ($i % 2 == 0) { ?>
                <tr class="cuadricula-fila cuadricula-fila-par">
                    <td style="width: <?php echo (3 * $anchoColumnas) + ($anchoColumnas / 2); ?>%;" class="cuadricula-fila cuadricula-leftlabel"><?php echo $servicios[$i] ?>
                    </td>
                    <td style="width: <?php echo $anchoColumnas * 3; ?>%;" class="cuadricula-fila">
                        <?php for ($j = 1; $j <= $numColumnas; $j++) {                            
                            //echo $servicios[$i];
                            ?>
                        
                            <input type="radio" obligatorio="<?=$pregunta->ca_obligatoria?>" idpregunta="<?=$pregunta->ca_id?>" class="star" id="grupo_<?php echo $pregunta->ca_id; ?>_<?php echo $j; ?>" value="<?php echo $j ?>" name="en<?php echo $i ?><?php echo $pregunta->ca_id ?>grupo<?=$formulario->getNumServicio($servicios[$i])?>">
                        <?php } ?>
                    </td>
                    <?php if ($device == 'desktop') { ?>
                        <td style="width: <?php echo $anchoColumnas / 2; ?>%;" class="cuadricula-fila cuadricula-spacer">
                        </td
                    <?php } ?>
                </tr>
            <?php 
            
            }
            if ($i % 2 == 1) { ?>
                <tr class="cuadricula-fila cuadricula-fila-impar">
                    <td style="width: <?php echo (1 * $anchoColumnas) + ($anchoColumnas / 2); ?>%;" class="cuadricula-fila cuadricula-leftlabel"><?php echo $servicios[$i] ?>
                    </td>
                    <td style="width: <?php echo $anchoColumnas * 3; ?>%;" class="cuadricula-fila">
                        <?php for ($j = 1; $j <= $numColumnas; $j++) { ?>
                            <input type="radio" obligatorio="<?=$pregunta->ca_obligatoria?>" idpregunta="<?=$pregunta->ca_id?>" class="star" id="grupo_<?php echo $pregunta->ca_id; ?>_<?php echo $j; ?>" value="<?php echo $j ?>" name="en<?php echo $i ?><?php echo $pregunta->ca_id ?>grupo<?=$formulario->getNumServicio($servicios[$i])?>">
                        <?php } ?>
                    </td>
                    <?php if ($device == 'desktop') { ?>
                        <td style="width: <?php echo $anchoColumnas / 2; ?>%;" class="cuadricula-fila cuadricula-spacer">
                        </td
                    <?php } ?>
                </tr>
        <?  }
        }
        ?>   
    </tbody>
</table>
<p class="parrafo area-adicional"> Comentarios adicionales</p>
<textarea class="parrafo area-adicional" id="en_<?php echo $pregunta->ca_id ?>"   name="en.<?php echo $pregunta->ca_id ?>.sencillo"></textarea>



