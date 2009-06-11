<?
use_helper("MimeType");



?>
<div class="content" >
<form action="<?=url_for("traficos/enviarCorreoTraficos")?>" method="post">
<input type="hidden" name="idcliente" id="idcliente" value="<?=$idCliente?>" />
<input type="hidden" name="modo" id="modo" value="<?=$modo?>" />


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

$contactos =  $cliente->getCaConfirmar();

include_component("general", "formEmail", array("subject"=>$subject, "message"=>$message, "contacts"=>$contactos));
?>
</div>
</<br />

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableForm">
	<tr>
		<td>
			<div align="left"><b>

				<input type="checkbox" name="adjuntar_excel" value="1" checked="checked" />
				Adjuntar documento de excel con contenido <br />
				 
				<?
				//Formato del documento en excel:<br>
				//select_tag("formato", array("1"=>"Formato 1", "2"=>"Formato 2"))?>
		</b></div></td>
	</tr>
</table>
<div align="left"><br>
<b>Adjuntos asociados a los reportes</b><br /><br />

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
		$class= $reporte->getColorStatus();			
		?>
	<tr class="<?=$class?>" id="tr_<?=$reporte->getCaIdreporte()?>" onclick="actualizar('<?=$reporte->getCaIdreporte()?>')" >
		<td><div align="left">
			<?=$reporte->getCaFchReporte()?>
		</div></td>
		<td><div align="left">
			<?=$reporte->getCaConsecutivo()." V".$reporte->getCaVersion()?>
		</div></td>
		<td><div align="left">
			<?=Utils::replace($reporte->getOrigen()->getCaCiudad())?>
		</div></td>
		<td><div align="left">
			<?=Utils::replace($reporte->getDestino()->getCaCiudad())?>
		</div></td>
		<td><div align="left">
			<?=$reporte->getProveedoresStr()?>
		</div></td>
		<td><div align="left">
			<?=$reporte->getConsignatario()?>
		</div></td>
	</tr>
	
	<tr >
		<td colspan="6"  > 
			<div align="left"><b>Adjuntar documento :</b><br />
			<?			
			foreach( $files as $file ){
				$fileIdx = $user->addFile( $file );
				?>
				<input type="checkbox" name="attachments[]" value="<?=base64_encode($file)?>" />
				<?
				echo mime_type_icon( basename($file) );
				?>
				<a href="#" onclick="popup('<?=url_for("traficos/fileViewer?idx=".$fileIdx."&token=".md5(time().basename($file)))?>')"  ><?=basename( $file )?></a>  
				<?				
			}
			?></div>
		</td>
	</tr>
	<?
	}
}
	?>
</table>
<div align="center"><input type="submit" class="button" value="Enviar" /></div>
</form>
</div>