
<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/

?>
<table width="100%" class="tableList alignLeft" >
    <tr>
        <th colspan="4"><b>Datos de exportaciones</b></th>
    </tr>
	<tr>
		<td width="213" >
			<b>Piezas:</b><br>
			<?=($repexpo->getCaPiezas())?str_replace("|", " ", $repexpo->getCaPiezas() ):""?>
		</td>
		<td width="201" ><b>Peso:</b> <br />
            <?=$repexpo->getCaPeso()?>
		</td>
		<td width="283" ><b>Volumen: </b><br>
            <?=$repexpo->getCaVolumen()?>            
            
		</td>
		<td width="167" >
			<b>Dimensiones:</b> <br />
			<?=$repexpo->getCaDimensiones()?>
		</td>
	</tr>
	<tr>
		<td colspan="2" >
			<b>Valor de Carga (USD):</b><br />
            <?=$repexpo->getCaValorcarga()?>
		</td>
		<td colspan="2"  valign="top"><b>Agente Aduanero:</b><br />
            <?=$repexpo->getSia()?>
        </td>
	</tr>

	<tr>
        <?
        if( $reporte->getcaTransporte()==Constantes::MARITIMO){
        ?>
		<td  >
			<div id="emisionbl">
			<b>Lugar de emisi&oacute;n BL</b><br />
			<?=$repexpo->getCaEmisionbl()?>
			</div>
        </td>
		<td >
			<div id="cuantosbl">
			<b>Cuantos BL? </b><br />
			<?=$repexpo->getCaNumbl()?>
			</div>
        </td>
        <?
        }else{
        ?>
        <td colspan="2">&nbsp;</td>
        <?
        }
        ?>
		<td  colspan="2"><b>Tipo de exportaci&oacute;n: </b><br>

            <?=$repexpo->getCaTipoexpo()?>
         </td>
	</tr>
	<tr>
		<td  >
			<b>Motonave/Vuelo</b><br />
            <?=$repexpo->getCaMotonave()?>
		</td>
		<td ><b>Solicitud anticipo</b><br />
			<?=$repexpo->getCaAnticipo()?></td>
		<td  colspan="2">&nbsp;</td>
	</tr>
</table>