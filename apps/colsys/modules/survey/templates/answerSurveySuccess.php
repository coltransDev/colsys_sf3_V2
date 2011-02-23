<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="content" align="center">
<table class="tableList">
    <tr>
        <th>
            Item a evaluar
        </th>
        <th>
            Calificaci&oacute;n
        </th>
    </tr>
    <?
    foreach( $criterios as $criterio ){
    ?>
    <tr>
        <td>
            <?=$criterio->getCaCriterio()?>
        </td>
        <td>
            <select>
                <?
                for( $i=10; $i>=1; $i-- ){
                    $texto = $i;

                    if( $i==10 ){
                        $texto.=" - Muy satisfecho";
                    }

                    if( $i==7 ){
                        $texto.=" - Satisfecho";
                    }

                    if( $i==5 ){
                        $texto.=" - Neutral";
                    }

                    if( $i==1 ){
                        $texto.=" - Nada Satisfecho";
                    }


                ?>
                <option value="<?=$i?>"><?=$texto?></option>
                <?
                }
                ?>
            </select>
        </td>
    </tr>
    <?
    }
    ?>
</table>
</div>