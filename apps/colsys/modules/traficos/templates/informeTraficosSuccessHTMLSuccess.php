<?

@require 'Spreadsheet/Excel/Writer.php';
error_reporting(E_ERROR ^ E_NOTICE);	

$xls = new Spreadsheet_Excel_Writer();

// Send HTTP headers to tell the browser what's coming
$xls->send("status".$idCliente.".xls");
// Add a worksheet to the file, returning an object to add data to
$sheet = $xls->addWorksheet($idCliente);


$colCargaEmbarcada = "#AED7FF";
$colNuevoestatus = "#DFFFFF";
$colPendienteInst = "#FFFFBB";

?>

<style type="text/css" >

#title{
	font-size: 11px;
	border:#000000 solid 1px;
	
}

#row1{
	font-size: 11px;
	
	
	/*border:#000000 solid 1px;
	vertical-align:top;*/
}

</style>
<?
if( $modo=="maritimo" ){
	$via = "VIA MAR&Iacute;TIMA";
}

if( $modo=="aereo" ){
	$via = "VIA A&Eacute;REA";
}

if( $modo=="exportaciones" ){
	$via = " DE EXPORTACIONES ";
}
?>

<table  >
	<tr>
		<td colspan="17" align="center"><strong><?="TRANSITO DE MERCANCIAS ".$via." ".$cliente->getCaCompania()?></strong></td>
	</tr>
	<tr>
	  <td><?=Utils::fechaMes(date("Y-m-d"))?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
	  <td ></td>
		<td ></td>
		<td >&nbsp;</td>
		<td >&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr id="title">
	  <td><strong>REPORTE</strong></td>
		<td><div align="left" ><strong>FECHA ACT STATUS</strong></div></td>
		<td><div align="left" ><strong>FECHA INICIO NEGOCIACION</strong></div></td>
		<td><div align="left" ><strong>ORIGEN</strong></div></td>
		<td><div align="left"><strong>DESTINO</strong></div></td>
		<td><div align="left"><strong>No DE PEDIDO</strong></div></td>
		<td><div align="left"><strong>PROVEEDOR</strong></div></td>
		<td><div align="left"><strong>CONSIGNEE</strong></div></td>
		<td><div align="left"><strong>INCOTERMS</strong></div></td>
		<td><div align="left"><strong>ETS</strong></div></td>
		<td><div align="left"><strong>ETA</strong></div></td>
		<td><div align="left"><strong>PIEZAS</strong></div></td>
		<td><div align="left"><strong>PESO</strong></div></td>
		<td><div align="left"><strong>VOLUMEN</strong></div></td>
		<td><div align="left"><strong>COL REF.</strong></div></td>
		<td><div align="left"><strong>HBL</strong></div></td>
		<td><div align="left"><strong>STATUS / ACCIONES A TOMAR</strong></div></td>
	</tr>
	<?		
	foreach( $reportes as $reporte ){
		if( !$reporte->esUltimaVersion() ){
			continue;
		}
		
		
		$aviso = $reporte->getUltimoAviso();	
		$status = $reporte->getUltimoStatus();	
		$mostrarStatus = false;
		$mostrarAviso = false;
		
		if( $aviso && $status ){
			if( Utils::compararFechas( $aviso?$aviso->getCaFchEnvio("Y-m-d"):"", $status?$status->getCaFchStatus("Y-m-d"):"" )>1 ){
				$mostrarAviso = true;
			}else{
				$mostrarStatus = true;
			}											
		}else{
			if( $aviso ){
				$mostrarAviso = true;
			}
			
			if( $status ){
				$mostrarStatus = true;
			}
		}
		
		$fecha ="";	
		$fchSalida = "";
		$fchLlegada =  "";
		$piezas = "";
		$peso = "";
		$volumen = "";
		$docTransporte = "";
		$notas = "";	
				
		$aviso = $reporte->getUltimoAviso();				
		
		if( $mostrarAviso ){
			$fecha = $aviso->getCaFchEnvio("Y-m-d");
			$fchSalida = $aviso->getCaFchSalida();
			$fchLlegada = $aviso->getCaFchLlegada();
			$piezas = str_replace("|", " ",$aviso->getCaPiezas());
			$peso = str_replace("|", " ",$aviso->getCaPeso());
			$volumen = str_replace("|", " ",$aviso->getCaVolumen() );
			$docTransporte = $aviso->getCaDoctransporte();
			$notas =$aviso->getCaNotas();	
				
		}
		if( $mostrarStatus ){
			
			if( $status ){					
				$fecha = $status->getCaFchStatus("Y-m-d");
				$notas = $status->getCaStatus();	
			}		
		}
		$etapa = $reporte->getCaEtapaActual(); 
		
		switch( $etapa ){				
			case "Pendiente de Coordinación":
				$bgcolor = $colPendienteInst;
				break;
			case "Carga Embarcada":
				$bgcolor = $colCargaEmbarcada;
				break;			
			default:
				if( $fecha==date("Y-m-d")){
					$bgcolor = $colNuevoestatus;
				}
				else{
					$bgcolor = "";
				}
				break;
		 
		}
		
	?>
	<tr id="row1" bgcolor="<?=$bgcolor?>">
	  <td valign="top" style="border-bottom:#333333 solid 1px;"><?=$reporte->getCaConsecutivo()." V".$reporte->getCaVersion()?></td>
		<td ><div align="left">
			<?=$fecha?>
		</div></td>
		<td><div align="left">
			<?=$reporte->getCaFchReporte()?>
		</div></td>
		<td><div align="left">
			<?=$reporte->getOrigen()?>
		</div></td>
		<td><div align="left">
			<?=$reporte->getDestino()?>
		</div></td>
		<td><div align="left">
			<?=$reporte->getCaOrdenClie()?>
		</div></td>
		<td><div align="left">
			<?=$reporte->getProveedor()?>
		</div></td>
		<td><div align="left">
			<?=$reporte->getConsignatario()?>
		</div></td>
		<td><div align="left">
			<?=$reporte->getCaIncoterms()?>
		</div></td>
		<td><div align="left">
			<?=$fchSalida?>
		</div></td>
		<td><div align="left">
			<?=$fchLlegada?>
		</div></td>
		<td><div align="left">
			<?=$piezas?>
		</div></td>
		<td><div align="left">
			<?=$peso?>
		</div></td>
		<td><div align="left">
			<?=$volumen?>
		</div></td>
		<td><div align="left">
			<?=""?>
		</div></td>
		<td><div align="left">
			<?=$docTransporte?>
		</div></td>
		<td ><?=Utils::replace($notas)?></td>
	</tr>
	
	<?
	
	
	}
	?>	
	<tr  >
	  <td >&nbsp;</td>
	  <td >&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr  >
		<td valign="top" id="row1"><strong>Convenciones</strong></td>
		<td colspan="4" valign="top" id="row1">&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr >
		<td id="row1" valign="top" bgcolor="<?=$colCargaEmbarcada?>">&nbsp;</td>
		<td id="row1"  colspan="4" valign="top">Carga embarcada</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr  >
	  <td id="row1" valign="top" bgcolor="<?=$colNuevoestatus?>">&nbsp;</td>
	  <td colspan="4" valign="top" id="row1">Status actualizado</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr  >
		<td id="row1" valign="top" bgcolor="<?=$colPendienteInst?>">&nbsp;</td>
		<td colspan="4" valign="top" id="row1">Pendiente por intrucciones</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr  >
	  <td id="row1" valign="top">&nbsp;</td>
	  <td colspan="4" valign="top" id="row1">Sin novedad </td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
</table>
