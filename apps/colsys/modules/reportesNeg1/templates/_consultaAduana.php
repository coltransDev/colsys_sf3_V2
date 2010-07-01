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
         <td colspan="3">
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
		<td  rowspan="3" valign="top"><b>Instrucciones Especiales</b><br />
			<?=$repaduana->getCaInstrucciones()?>
		</td>
	</tr>
    <?
    if( $reporte->getCaImpoexpo()==Constantes::IMPO){
    ?>
	<tr id="aduana-row1">
		<td >
            <b>Con Coltrans:</b>
            <?=$repaduana->getCaTransnacarga()?>
        </td>
	</tr>
    <?
    }
    ?>
	<tr id="aduana-row2">
		<td ><b>Tipo:</b>
            <?=$repaduana->getCaTransnatipo()?>
			</td>
	</tr>



</table>
