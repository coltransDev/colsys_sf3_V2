
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
		<td width="213" <?=($comparar)? (($reporte->compDato("RepExpo()->getCaPiezas")!=0)?"class='rojo'":"") :""?> >
			<b>Piezas:</b><br>
			<?=($repexpo->getCaPiezas())?str_replace("|", " ", $repexpo->getCaPiezas() ):""?>
		</td>
		<td width="201" <?=($comparar)? (($reporte->compDato("RepExpo()->getCaPeso")!=0)?"class='rojo'":"") :""?> ><b>Peso:</b> <br />
            <?=$repexpo->getCaPeso()?>
		</td>
		<td width="283" <?=($comparar)? (($reporte->compDato("RepExpo()->getCaVolumen")!=0)?"class='rojo'":"") :""?> ><b>Volumen: </b><br>
            <?=$repexpo->getCaVolumen()?>
		</td>
		<td width="167" <?=($comparar)? (($reporte->compDato("RepExpo()->getCaDimensiones")!=0)?"class='rojo'":"") :""?> >
			<b>Dimensiones:</b> <br />
			<?=$repexpo->getCaDimensiones()?>
		</td>
	</tr>
	<tr>
		<td colspan="2" <?=($comparar)? (($reporte->compDato("RepExpo()->getCaValorcarga")!=0)?"class='rojo'":"") :""?> >
			<b>Valor de Carga (USD):</b><br />
            <?=$repexpo->getCaValorcarga()?>

		</td>
		<td colspan="2"  valign="top" <?=($comparar)? (($reporte->compDato("RepExpo()->getSia")!=0)?"class='rojo'":"") :""?>><b>Agente Aduanero:</b><br />
            <?=$repexpo->getSia()?>
        </td>
	</tr>

	<tr>
        <?
        if( $reporte->getcaTransporte()==Constantes::MARITIMO){
        ?>
		<td  >
			<div id="emisionbl" <?=($comparar)? (($reporte->compDato("RepExpo()->getCaEmisionbl")!=0)?"class='rojo'":"") :""?>>
			<b>Lugar de emisi&oacute;n BL</b><br />
			<?=$repexpo->getCaEmisionbl()?>
			</div>
        </td>
		<td >
			<div id="cuantosbl" <?=($comparar)? (($reporte->compDato("RepExpo()->getCaNumbl")!=0)?"class='rojo'":"") :""?>>
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
		<td  colspan="2" <?=($comparar)? (($reporte->compDato("RepExpo()->getCaTipoexpo")!=0)?"class='rojo'":"") :""?>><b>Tipo de exportaci&oacute;n: </b><br>

            <?=$repexpo->getCaTipoexpo()?>
         </td>
	</tr>
	<tr>
		<td <?=($comparar)? (($reporte->compDato("RepExpo()->getCaMotonave")!=0)?"class='rojo'":"") :""?> >
			<b>Motonave/Vuelo</b><br />
            <?=$repexpo->getCaMotonave()?>
		</td>
		<td <?=($comparar)? (($reporte->compDato("RepExpo()->getCaAnticipo")!=0)?"class='rojo'":"") :""?> ><b>Solicitud anticipo</b><br />
			<?=$repexpo->getCaAnticipo()?></td>
		<td  colspan="2">&nbsp;</td>
	</tr>
</table>