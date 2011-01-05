<?
$consignatario_m = $sf_data->getRaw("consignatario_m");
$master = $sf_data->getRaw("master");
$notify_h = $sf_data->getRaw("notify_h");
$hijo = $sf_data->getRaw("hijo");
?>
<table width="100%" cellspacing="1" border="1" class="tableList">
<tr>
	<td colspan="4"><center>
			<b>SEAFREIGHT BUSINESS REPORT</b>
		</center></td>
</tr>
<?
$ordenes = array_combine(explode("|",$reporte->getCaIdproveedor()), explode("|",$reporte->getCaOrdenProv()) ); 
 
$proveedores = $reporte->getProveedores();

$i=1;
foreach( $proveedores as $proveedor ){
?>
<tr>
	<td width="24%"><b>SHIPPER
		<?=(count($proveedores)>1)?"# $i":""?>
		</b></td>
	<td width="76%" colspan="3"><?=$proveedor->getCaNombre()?></td>
</tr>
<tr>
	<td><b>ADDRESS :</b></td>
	<td colspan="3"><?=$proveedor->getCaDireccion()?></td>
</tr>
<tr>
	<td><b>PHONE :</b></td>
	<td colspan="3"><?=$proveedor->getCaTelefonos()?></td>
</tr>
<tr>
	<td><b>FAX :</b></td>
	<td colspan="3"><?=$proveedor->getCaFax()?></td>
</tr>
<tr>
	<td><b>CONTACT :</b></td>
	<td colspan="3"><?=$proveedor->getCaContacto()?></td>
</tr>
<tr>
	<td><b>E-MAIL :</b></td>
	<td colspan="3"><?=$proveedor->getCaEmail()?></td>
</tr>
<tr>
	<td><b>ORDER SUPPLIER :</b></td>
	<td colspan="3"><?=$ordenes[$proveedor->getCaIdtercero()]?></td>
</tr>
<tr>
	<td colspan="4">&nbsp;</td>
</tr>
<?  
$i++;              
}
?>
<tr>
	<td><b>ORDER CONSIGNEE :</b></td>
	<td colspan="3"><?=$reporte->getCaOrdenClie()?></td>
</tr>
<tr>
	<td><b>INCOTERMS :</b></td>
	<td colspan="3"><?=$reporte->getCaIncoterms()?></td>
</tr>
<tr>
	<td><b>PORT LOADING :</b></td>
	<td colspan="3"><?=$reporte->getOrigen()->getCaCiudad()?></td>
</tr>
<tr>
	<td><b>PORT DISCHARGE :</b></td>
	<td colspan="3"><?=$reporte->getDestino()->__toString()?></td>
</tr>
<?			

if ( $reporte->getCaContinuacion() != 'N/A' ){
?>
<tr>
	<td><b>IN BOND TO :</b></td>
	<td colspan="3"><?=$reporte->getDestinoCont()->__toString()?></td>
</tr>
<?	
}
?>
<tr>
	<td><b>NATURE GOODS :</b></td>
	<td colspan="3"><?=$reporte->getCaMercanciaDesc()?></td>
</tr>
<tr>
	<td colspan="4">&nbsp;</td>
</tr>
<tr>
	<td><b>CARGO AVAILABLE :</b></td>
	<td colspan="3"><?=$reporte->getCaFchdespacho()?></td>
</tr>
<?			 
		 

if ( $reporte->getCaIdlinea() ){
?>
<tr>
	<td style="vertical-align:top"><b>SHIPPING LINE:</b></td>
	<td colspan="3"><?=$reporte->getIdsProveedor()->getIds()->getCaNombre()?></td>
</tr>
<?	
}
			 
if ( ( ($reporte->getCaModalidad() != 'LCL') || ($reporte->getCaImpoexpo() == constantes::TRIANGULACION)) && $master){
?>
<tr>
	<td style="vertical-align:top;"><b>MBL CONSIGNED TO:</b></td>
	<td colspan="3"><?=$master?></td>
</tr>
<tr>
	<td style="vertical-align:top"><b>NOTIFY:</b></td>
	<td colspan="3"><?=$consignatario_m?></td>
</tr>
<?
}
?>
<tr>
	<td colspan="4">&nbsp;</td>
</tr>
<tr>
	<td style="vertical-align:top"><b>HBL CONSIGNED TO:</b></td>
	<td colspan="3"><?=$hijo?></td>
</tr>
<tr>
	<td style="vertical-align:top"><b>NOTIFY:</b></td>
	<td colspan="3"><?=$notify_h?></td>
</tr>
<tr>
	<td bgcolor="#CCCCCC" colspan="4"><center>
			<b>SELLING RATES</b>
		</center></td>
</tr>
<tr>
	<td colspan="4">
		<table border="1" cellspacing="1" width="100%">
			<?		
		foreach( $tarifas as $tarifa ){
		?>
			<tr>
				<td style="vertical-align:bottom" bgcolor="#CCCCCC" width="30%"><b>Ocean Freight :</b><br />
					<?
				echo $tarifa->getConcepto()->getCaConcepto();
				
				if( $tarifa->getCaCantidad()>0 ){
					echo "[Cant.: ".Utils::formatNumber( $tarifa->getCaCantidad() ,3)."]";
				}
				?>				</td>
				<td style="vertical-align:bottom" bgcolor="#CCCCCC" width="70%"><table border="1" cellspacing="0" width="100%">
						<tr>
							<?					
					if ( $tarifa->getCaNetaTar() > 0 ){
					?>
							<td bgcolor="#CCCCCC" width="25%"><b>Buying Rate :</b><br />
								<?=number_format($tarifa->getCaNetaTar(),2)." ".$tarifa->getCaNetaIdm()?>							</td>
							<?	
					}
					if ($tarifa->getCaNetaMin() > 0){
					?>
							<td bgcolor="#CCCCCC" width="25%"><b>Minimum :</b><br />
								<?=number_format($tarifa->getCaNetaMin(),2)." ".$tarifa->getCaNetaIdm()?>							</td>
							<?							
					}
					
					if ($tarifa->getCaReportarTar() > 0){
					?>
							<td bgcolor="#CCCCCC" width="25%"><b>Selling Rate :</b><br />
								<?=number_format($tarifa->getCaReportarTar(),2)." ".$tarifa->getCaReportarIdm()?>							</td>
							<?							
					}
					if ($tarifa->getCaReportarMin() > 0){
					?>
						<td bgcolor="#CCCCCC" width="25%"><b>Minimum :</b><br />
								<?=number_format($tarifa->getCaReportarMin(),2)." ".$tarifa->getCaReportarIdm()?>					</td>
					<?							
					}					
					?>
						</tr>
					</table></td>
			</tr>
			<?
			foreach( $gastos as $gasto ){
				if ($gasto->getCaIdconcepto() == $tarifa->getCaIdconcepto() ){


                                    if ( $gasto->getCaNetaTar()== 0 and $gasto->getCaReportarTar() == 0) {
                                        continue;
                                    }
			?>
			<tr>
				<td style="vertical-align:bottom" width="30%"><b>
					<?=$gasto->getTipoRecargo()->getCaRecargo()?>
				</b></td>
				<td style="vertical-align:bottom" width="70%"><table border="1" cellspacing="0" width="100%">
						<tr>
							<? 
							if ($gasto->getCaNetaTar() != 0){
							?>
							<td><b>Buying Rate :</b><br />
								<?=(($gasto->getCaTipo()=='$')?number_format($gasto->getCaNetaTar() ,2)." ".$gasto->getCaIdmoneda():number_format($gasto->getCaNetaTar(),2).$gasto->getCaTipo())?>							</td>
							<?	
							}							
							if ($gasto->getCaNetaMin() != 0){
							?>
							<td><b>Minimum :</b><br />
								<?=number_format($gasto->getCaNetaMin() ,2)." ".$gasto->getCaIdmoneda()?>							</td>
							<?	
							}
							if ($gasto->getCaReportarTar() != 0){
							?>
							<td><b>Selling Rate :</b><br />
								<?=(($gasto->getCaTipo()=='$')?number_format($gasto->getCaReportarTar() ,2)." ".$gasto->getCaIdmoneda():number_format($gasto->getCaReportarTar(),2).$gasto->getCaTipo())?>							</td>
							<?
							}
							
							if ($gasto->getCaReportarMin() != 0){							
							?>
							<td><b>Minimum :</b><br />
								<?=number_format($gasto->getCaReportarMin(),2)." ".$gasto->getCaIdmoneda()?>							</td>
							<?
							}
							?>
						</tr>
					</table></td>
			</tr>
			<?	
				}	
			}			
		}
		?>
			<tr>
				<td bgcolor="#CCCCCC" colspan="4"><center>
						<b>General Charges</b>
					</center></td>
			</tr>
			<?
		foreach( $gastos as $gasto ){			
			if ( $gasto->getCaNetaTar()== 0 and $gasto->getCaReportarTar() == 0) {			
				continue;
			}
			if ($gasto->getCaIdconcepto() == '9999'){
		?>
			<tr>
				<td style="vertical-align:bottom" width="30%"><b>
					<?=$gasto->getTipoRecargo()->getCaRecargo()?>
				</b></td>
				<td style="vertical-align:bottom" width="70%"><table border="1" cellspacing="0" width="100%">
						<tr>
							<? 
						if ($gasto->getCaNetaTar() != 0){
						?>
							<td><b>Buying Rate :</b><br />
								<?=(($gasto->getCaTipo()=='$')?number_format($gasto->getCaNetaTar() ,2)." ".$gasto->getCaIdmoneda():number_format($gasto->getCaNetaTar(),2).$gasto->getCaTipo())?>							</td>
							<?	
						}							
						if ($gasto->getCaNetaMin() != 0){
						?>
							<td><b>Minimum :</b><br />
								<?=number_format($gasto->getCaNetaMin() ,2)." ".$gasto->getCaIdmoneda()?>							</td>
							<?	
						}
						if ($gasto->getCaReportarTar() != 0){
						?>
							<td><b>Selling Rate :</b><br />
								<?=(($gasto->getCaTipo()=='$')?number_format($gasto->getCaReportarTar() ,2)." ".$gasto->getCaIdmoneda():number_format($gasto->getCaReportarTar(),2).$gasto->getCaTipo())?>							</td>
							<?
						}						
						if ($gasto->getCaReportarMin() != 0){							
						?>
							<td><b>Minimum :</b><br />
								<?=number_format($gasto->getCaReportarMin(),2)." ".$gasto->getCaIdmoneda()?>							</td>
							<?
						}
						?>
						</tr>
					</table></td>
			</tr>
			<?
			}		
		}
		?>
		</table>
</td>
</tr>
</table>
