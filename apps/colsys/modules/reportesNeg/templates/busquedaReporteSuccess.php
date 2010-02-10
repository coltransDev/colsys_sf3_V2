<?
/*
* Muestra los resultados de la busqueda del reporte de negocios 
* @author Andres Botero
*/	
?>
<div align="center">
<table width="800px" border="1" class="tableList alignLeft">
	<tr>
		<th width="70" scope="col">Consecutivo</th>
		<th width="668" scope="col">Trayecto</th>
	</tr>
	<?
	foreach( $reportes as $reporte ){		
		$origen = $reporte->getOrigen();
		$destino = $reporte->getDestino();

        $url = "reportesNeg/consultaReporte?id=".$reporte->getCaIdreporte().($opcion?"&opcion=".$opcion:"");
	?>
	<tr>
		<td rowspan="2"  ><?=link_to($reporte->getCaConsecutivo()." V".$reporte->getCaVersion(), $url )?></td>
		<td  >
			<?="<b>".$reporte->getCliente()."</b> (".$reporte->getCaTransporte()." ".$reporte->getCaModalidad().")"?>
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
                        <td width="20%" class="invertir" style="font-weight: bold;">Orden</td
						<td width="21%" class="invertir" style="font-weight: bold;">Cotizaci&oacute;n</td>
					</tr>
					<tr>
						<td class="listar"><?=$origen?$origen->getTrafico()."->".$origen->getCaCiudad():"&nbsp;"?></td>
						<td class="listar"><?=$destino?$destino->getTrafico()."->".$destino->getCaCiudad():"&nbsp;"?></td>
						<td class="listar"><?=$reporte->getCaFchreporte()?></td>
						<td class="listar"><?=$reporte->getCaIncoterms()?></td>
                        <td class="listar"><?=$reporte->getCaOrdenClie()?></td>
						<td class="listar"><?=$reporte->getCaIdcotizacion()?></td>
					</tr>
				</tbody>
			</table></td>
	</tr>
	<?
	}
	?>
</table>
</div>
<?
include_component("kbase","tooltipById", array("idcategory"=>18));
if( $opcion=="ayudas" ){
    include_component("kbase","tooltipCreator", array("idcategory"=>18));
}
?>