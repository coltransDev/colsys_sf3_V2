<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<table class="tableList alignLeft" width="100%">
     <tr >
         <th colspan="3" ><b>Aduana</b></th>
     </tr>
     <tr>
         <td colspan="3" <?=($comparar)? (($reporte->compDato("CaColmas")!=0)?"class='rojo'":"") :""?>>
            <?=$reporte->getCaColmas()?>
        </td>
    </tr>
    <tr id="aduana-row0">
        <td  >
            <div id="titulo-aduana" >
                <?
                if( $reporte->getCaImpoexpo()==Constantes::IMPO){
                ?>
                <b>Transporte de carga nacionalizada</b>
                <?
                }else{
                ?>
                <b>Transporte Nacional</b>
                <?
                }
                ?>
            </div>
        </td>
		<td  rowspan="3" valign="top" <?=($comparar)? (($reporte->compDato("RepAduana()->getCaInstrucciones")!=0)?"class='rojo'":"") :""?>><b>Instrucciones Especiales</b><br />
			<?=$repaduana->getCaInstrucciones()?>
		</td>
	</tr>
    <?
    if( $reporte->getCaImpoexpo()==Constantes::IMPO){
    ?>
	<tr id="aduana-row1">
		<td <?=($comparar)? (($reporte->compDato("RepAduana()->getCaTransnacarga")!=0)?"class='rojo'":"") :""?> >
            <b>Con Coltrans:</b>
            <?=$repaduana->getCaTransnacarga()?>
        </td>
	</tr>
    <?
    }
    ?>
	<tr id="aduana-row2">
		<td <?=($comparar)? (($reporte->compDato("RepAduana()->getCaTransnatipo")!=0)?"class='rojo'":"") :""?> ><b>Tipo:</b>
            <?=$repaduana->getCaTransnatipo()?>
			</td>
	</tr>
</table>
