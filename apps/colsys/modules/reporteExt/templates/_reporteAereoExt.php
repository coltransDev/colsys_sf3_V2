
<table width="100%" cellspacing="1" border="1" class="tableList">
<tr>
	<td colspan="4"><center>
			<b>AIRFREIGHT BUSINESS REPORT</b>
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
	<td><b>CLIENT ORDER :</b></td>
	<td colspan="3"><?=$reporte->getCaOrdenClie()?></td>
</tr>
<tr>
	<td><b>INCOTERMS :</b></td>
	<td colspan="3"><?=$reporte->getCaIncoterms()?></td>
</tr>
<tr>
	<td><b>ORIGEN :</b></td>
	<td colspan="3"><?=$reporte->getOrigen()->getCaCiudad()?></td>
</tr>
<tr>
	<td><b>CARGO AVAILABLE :</b></td>
	<td colspan="3"><?=$reporte->getCaFchdespacho()?></td>
</tr>

<?			
if ( $reporte->getCaIdlinea() ){
?>
<tr>
	<td style="vertical-align:top"><b>AIRLINE:</b></td>
	<td colspan="3"><?=$reporte->getTransportador()->getCaNombre()?></td>
</tr>
<?	
}

 
 

	 

if( $reporte->getCaIdmaster()){
	$consignatario = TerceroPeer::retrieveByPk( $reporte->getCaIdmaster() );
	 $master = $consignatario->getCaNombre()."<BR>".$consignatario->getCaContacto()."<BR>Dirección: ".$consignatario->getCaDireccion()."<BR>Teléfonos:".$consignatario->getCaTelefonos()." Fax:".$consignatario->getCaFax()."<BR>Email: ".$consignatario->getCaEmail();
}else {
	$consignatario = ClientePeer::retrieveByPk( 800024075 );	
	$master = $consignatario->getCaCompania()." Nit. ".number_format($consignatario->getCaIdcliente(),0)."-".$consignatario->getCaDigito()."<BR>Dirección: ".str_replace ("|"," ",$consignatario->getCaDireccion())."<BR>Teléfonos:".$consignatario->getCaTelefonos()." Fax:".$consignatario->getCaFax()."<BR>".$consignatario->getCiudad()->__toString();
}

if( $reporte->getCaIdConsignatario() ){

	$consignatario = TerceroPeer::retrieveByPk( $reporte->getCaIdConsignatario() );
	$consignatario_final = $consignatario->getCaNombre()." Nit. ".$consignatario->getCaIdentificacion()."<BR>Contacto: ".$consignatario->getCaContacto()."<BR>Dirección: ".$consignatario->getCaDireccion()."<BR>Teléfonos:".$consignatario->getCaTelefonos()." Fax:".$consignatario->getCaFax()."<BR>Email: ".$consignatario->getCaEmail();
		
}else{
	$contacto = $reporte->getContacto();
	$cliente = $reporte->getContacto()->getCliente();
	
	$consignatario_final = $cliente->getCaCompania()." Nit. ".number_format($cliente->getCaIdcliente(),0)."-".$cliente->getCaDigito()."<BR>Contacto: ".$contacto->getCaNombres()." ".$contacto->getCaPapellido()." ".$contacto->getCaSapellido()."<BR>Dirección: ".str_replace ("|"," ",$cliente->getCaDireccion())."<BR>Teléfonos:".$contacto->getCaTelefonos()." Fax:".$contacto->getCaFax()."<BR> Email:".$contacto->getCaEmail();		
}


if( $reporte->getCaIdconsignar()==1 ){
	$hijo = $consignatario_final;
}else{
	$bodegaConsignar = $reporte->getBodegaConsignar();
	$hijo = $bodegaConsignar->getCaNombre();
}


if( !$reporte->getCaNotify() ){	
	$contacto = $reporte->getContacto();
	$cliente = $reporte->getContacto()->getCliente();
	
	$consignatario_h = $cliente->getCaCompania()."<BR>: ".$contacto->getCaNombres()." ".$contacto->getCaPapellido()." ".$contacto->getCaSapellido()."<BR>".str_replace ("|"," ",$cliente->getCaDireccion())."<BR>".$cliente->getCiudad()->getTrafico()->getcaNombre();		
}else{

	if( $reporte->getCaNotify()==1 ) {	
		$notify = TerceroPeer::retrieveByPk( $reporte->getCaIdConsignatario() );
	}elseif(  $reporte->getCaNotify()==2 ){
		$notify = TerceroPeer::retrieveByPk( $reporte->getCaNotify() );
	}
	
	$consignatario_h = $notify->getCaNombre()." Nit. ".$notify->getCaIdentificacion()."<BR>Contacto: ".$notify->getCaContacto()."<BR>Dirección: ".$notify->getCaDireccion()."<BR>Teléfonos:".$notify->getCaTelefonos()." Fax:".$notify->getCaFax()."<BR>Email: ".$notify->getCaEmail();	
}

if ( $reporte->getCaMastersame() == 'Sí' ){
	$master = $hijo;
}

?>
<tr>
	<td colspan="4">&nbsp;</td>
</tr>

<tr>
	<td colspan="4"><center><b>MAWB INSTRUCTIONS</b></center></td>
</tr>

<tr>
	<td><b>CONSIGNED TO:</b></td>
	<td colspan="3"><?=$master?></td>
</tr>
<tr>
	<td><b>FINAL DESTINATION:</b></td>
	<td colspan="3"><?=$reporte->getDestino()->__toString()?></td>
</tr>
<tr>
	<td><b>NATURE OF GOODS:</b></td>
	<td colspan="3">CONSOLIDATION AS PER ATTACHED CARGO MANIFEST.</td>
</tr>

<tr>
	<td colspan="4">&nbsp;</td>
</tr>

<tr>
	<td colspan="4"><center><b>HAWB INSTRUCTIONS</b></center></td>
</tr>

<tr>
	<td><b>CONSIGNED TO:</b></td>
	<td colspan="3"><?=$hijo?></td>
</tr>
<?
if (strlen($consignatario_h) != 0){
?>
<tr>
	<td><b>NOTIFY:</b></td>
	<td colspan="3"><?=$consignatario_h?></td>
</tr>
<?
}

if ( $reporte->getCaContinuacion() != 'N/A' ){
?>
<tr>
	<td><b>FINAL DESTINATION:</b></td>
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
	<td><b>FREIGHT:</b></td>
	<td colspan="3">AS AGREED</td>
</tr>
<tr>
	<td colspan="4">&nbsp;</td>
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
				<td style="vertical-align:bottom" bgcolor="#CCCCCC" width="30%"><b>Airfreight :</b><br />
					<?
				echo $tarifa->getConcepto()->getCaConcepto();
				
				if( $tarifa->getCaCantidad()>0 ){
					echo "[Cant.: ".Utils::formatNumber( $tarifa->getCaCantidad() ,3)."]";
				}
				?>				</td>
				<td style="vertical-align:bottom" bgcolor="#CCCCCC" width="70%"><table border="1" cellspacing="0" width="100%">
					<?					
					if ($tarifa->getCaReportarTar() > 0){
					?>
							<td bgcolor="#CCCCCC" width="25%"><b>Selling Rate :</b><br />
								<?=number_format($tarifa->getCaReportarTar(),2)." ".$tarifa->getCaReportarIdm()?>							</td>
							<?							
					}
					if ($tarifa->getCaReportarMin() > 0){
					?>
							<td bgcolor="#CCCCCC" width="25%"><b>Minimum :</b><br />
								<?=number_format($tarifa->getCaReportarMin(),2)." ".$tarifa->getCaReportarIdm()?>							</td>
							<?							
					}
					
					?>
						</tr>
					</table></td>
			</tr>
		<?					
		}		
		?>
		</table>
</td>
</tr>
</table>
