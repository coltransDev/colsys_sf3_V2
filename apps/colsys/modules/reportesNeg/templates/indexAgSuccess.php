<?
/**
* Pantalla de bienvenida para el modulo de reportes
* @author Andres Botero, Mauricio Quinche
*/
//$this->reportesAg
?>
<div align="center">
<table width="800px" border="1" class="tableList alignLeft">
	<tr>
		<th width="70" scope="col">Consecutivo</th>
		<th width="668" scope="col">Trayecto</th>
	</tr>
	<?
	foreach( $reportesAg as $reporte ){
		$origen = $reporte["ca_ciuorigen"];
		$destino = $reporte["ca_ciudestino"];
        $url = "reportesNeg/consultaReporte?id=".$reporte["ca_idreporte"]."&modo=".$reporte["ca_transporte"]."&impoexpo=".Constantes::IMPO;
	?>
	<tr>
		<td rowspan="2"><?=link_to($reporte["ca_consecutivo"], $url )?></td>
		<td  >
			<?="<b>".$reporte["ca_nombre_cli"]."</b> (".$reporte["ca_transporte"]." ".$reporte["ca_modalidad"].")"?>
			</td>
	</tr>
	<tr >
		<td  ><table width="100%" >
				<tbody>
					<tr>
						<td class="invertir" style="font-weight: bold;">Origen</td>
						<td class="invertir" style="font-weight: bold;">Destino</td>
						<td width="20%" class="invertir" style="font-weight: bold;">Fch.Despacho</td>
						<td width="60%" class="invertir" style="font-weight: bold;">Proveedor</td>
                        
					</tr>
					<tr>
						<td class="listar"><?=$origen?></td>
						<td class="listar"><?=$destino?></td>
						<td class="listar"><?=$reporte["ca_fchreporte"]?></td>
						<td class="listar"><?=$reporte["ca_nombre_pro"]?></td>
					</tr>
				</tbody>
			</table></td>
	</tr>
	<?
	}
	?>
</table>
</div>
