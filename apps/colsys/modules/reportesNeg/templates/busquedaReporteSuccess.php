<?
/*
* Muestra los resultados de la busqueda del reporte de negocios 
* @author Andres Botero
*/	
?>
<div align="center">
<table width="800px" border="1" class="tableList">
	<tr>
		<th width="57" scope="col">Consecutivo</th>
		<th width="57" scope="col">Versi&oacute;n</th>
		<th width="668" scope="col">Trayecto</th>
	</tr>
	<?
	foreach( $reportes as $reporte ){
		if( !$reporte->esUltimaVersion() ){
			continue;
		}
		$origen = $reporte->getOrigen();
		$destino = $reporte->getDestino();
		
	?>
	<tr>
		<td rowspan="2"  ><?=link_to($reporte->getCaConsecutivo(), "reportesNeg/consultaReporte?reporteId=".$reporte->getCaIdreporte()."&modo=".$modo)?></td>
		<td rowspan="2"  ><?=link_to($reporte->getCaVersion()." ", "reportesNeg/consultaReporte?reporteId=".$reporte->getCaIdreporte()."&modo=".$modo)?></td>
		<td  >
			<?=link_to($reporte->getCliente(), "reportesNeg/consultaReporte?reporteId=".$reporte->getCaIdreporte()."&modo=".$modo)?>
			</td>
	</tr>
	<tr >
		<td  ><table width="100%" >
				<tbody>
					<tr>
						<td class="invertir" style="font-weight: bold;">Origen</td>
						<td class="invertir" style="font-weight: bold;">Destino</td>
						<td width="20%" class="invertir" style="font-weight: bold;">Fch.Despacho</td>
						<td width="20%" class="invertir" style="font-weight: bold;">T.Incoterms</td>
						<td width="21%" class="invertir" style="font-weight: bold;">Cotizaci&oacute;n</td>
					</tr>
					<tr>
						<td class="listar"><?=$origen?$origen->getTrafico()."->".$origen->getCaCiudad():"&nbsp;"?></td>
						<td class="listar"><?=$destino?$destino->getTrafico()."->".$destino->getCaCiudad():"&nbsp;"?></td>
						<td class="listar"><?=$reporte->getCaFchreporte()?></td>
						<td class="listar"><?=$reporte->getCaIncoterms()?></td>
						<td class="listar">&nbsp;</td>
					</tr>
				</tbody>
			</table></td>
	</tr>
	<?
	}
	?>
</table>
</div>