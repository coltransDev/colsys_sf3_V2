<?
use_helper("MimeType", "Popup", "Validation");

$fileIdx = 0;

echo form_tag("traficos/enviarCorreoTraficos");
echo input_hidden_tag("idcliente", $idCliente);
echo input_hidden_tag("fechaInicial", $fechaInicial);
echo input_hidden_tag("fechaFinal", $fechaFinal);
echo input_hidden_tag("modo", $modo);
echo input_hidden_tag("ver", $ver);


?>
<div align="left">
<?
$subject=Utils::fechaMes(date("Y-m-d")). " - CUADRO DE SEGUIMIENTOS - ".$cliente->getCaCompania();
$message="Señores\n\n".$cliente->getCaCompania()."\n".$cliente->getCiudad()."\n\n";
$hora = date("G");
if( $hora <12 ){
	$message.="Buenos dias,";
}elseif($hora <19){
	$message.="Buenas tardes,";
}else{
	$message.="Buenas noches,";
}	
$message.="\n\nRemitimos  cuadro de seguimientos con status de las cargas que estamos manejando actualmente.";
$message.="\n\nQuedamos a  su  entera  disposición  para  atender  cualquier inquietud adicional.";
$message.="\n\nReciban un cordial saludo,\n\n";
$message.=$usuario->getFirma();



include_component("general", "formEmail", array("subject"=>$subject, "message"=>$message));
?>
</div>
</<br />

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableForm">
	<tr>
		<td>
			<div align="left"><strong>
				<?=checkbox_tag("adjuntar_excel", 1, 1)?> 
				Adjuntar documento de excel con contenido <br />
				 
				<?
				//Formato del documento en excel:<br>
				//select_tag("formato", array("1"=>"Formato 1", "2"=>"Formato 2"))?>
		</strong></div></td>
	</tr>
</table>
<div align="left"><br>
<strong>Adjuntos asociados a los reportes</strong><br>
</div>
	

<table width="100%" border="1" class="tableList" id="lista">
	<tr>
		<th scope="col"><div align="left">Fecha Rep </div></th>
		<th scope="col"><div align="left">Reporte</div></th>
		<th scope="col"><div align="left">Origen</div></th>
		<th scope="col"><div align="left">Destino</div></th>
		<th scope="col"><div align="left">Proveedor</div></th>
		<th scope="col"><div align="left">CNEE</div></th>
	</tr>
<?
foreach( $reportes as $reporte ){
	if( !$reporte->esUltimaVersion() ){
		continue;
	}
	

	$files = $reporte->getFiles();
	if( count($files) ){	
		$etapa = $reporte->getCaEtapaActual(); 
		switch( $etapa ){				
			case "Pendiente de Coordinación":
				$class = "yellow";
				break;
			case "Carga Embarcada":
				$class = "blue";
				break;			
			default:
				/*if( $fecha==date("Y-m-d")){
					$class = "green";
				}
				else{
					$class = "";
				}*/
				$class = "";
				break;
		 
		}
			
		?>
	<tr class="<?=$class?>" id="tr_<?=$reporte->getCaIdreporte()?>" onclick="actualizar('<?=$reporte->getCaIdreporte()?>')" >
		<td><div align="left">
			<?=$reporte->getCaFchReporte()?>
		</div></td>
		<td><div align="left">
			<?=$reporte->getCaConsecutivo()." V".$reporte->getCaVersion()?>
		</div></td>
		<td><div align="left">
			<?=Utils::replace($reporte->getOrigen())?>
		</div></td>
		<td><div align="left">
			<?=Utils::replace($reporte->getDestino())?>
		</div></td>
		<td><div align="left">
			<?=$reporte->getProveedor()?>
		</div></td>
		<td><div align="left">
			<?=$reporte->getConsignatario()?>
		</div></td>
	</tr>
	
	<tr >
		<td colspan="6"  > 
			<div align="left"><strong>Adjuntar documento :</strong><br />
			<?			
			foreach( $files as $file ){
				$user->addFile( $file, $fileIdx );
				echo checkbox_tag("attachments[]", base64_encode($file) )." ".mime_type_icon( basename($file) )." ".link_popup(basename( $file ),"gestDocumental/fileViewer?idx=".$fileIdx."&token=".md5(time().basename($file)),"800","600" )."<br />";
				$fileIdx++;
			}
			?></div>
		</td>
	</tr>
	<?
	}
}
	?>
</table>
<div align="center"><?=submit_tag("Enviar")?></div>
</form>