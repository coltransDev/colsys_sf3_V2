<?
use_helper("MimeType");


?>
<ul>
<?
foreach( $files as $file ){
	//$fileIdx = $user->addFile( $file );
    if( substr($file, -3,3)==".gz"){
        $nombreArchivo = substr($file,0, strlen($file)-3);
    }else{
        $nombreArchivo = $file;
    }
	?>
	<li>
		<?=mime_type_icon( basename($file) )?> 
        <a href="<?=url_for("traficos/fileViewer?idreporte=".$reporte->getCaIdreporte()."&file=".base64_encode(basename($file)) )?>" target="_blank"><?=basename( $nombreArchivo )?></a>
		
		<?
		if( $nivel>0 ){
		?>
		<a href="#" onclick="eliminarArchivos('<?=$reporte->getCaIdreporte()?>', '<?=base64_encode(basename($file))?>')"><?=image_tag("16x16/delete.gif")?></a>
		<?
		}
		?>
		
	</li>
	<?
	echo "</li>";
	
}

?>
</ul>
<?
if( $nivel>0 ){
?>
<form action="<?=url_for("traficos/cargarArchivo")?>"  target="uploadFrame" enctype="multipart/form-data" method="post" />
	<input type="hidden" name="idreporte" value="<?=$reporte->getCaIdreporte()?>" />
<table width="100%" border="0" class="tableForm">
	
	<tr>
		<td width="50%"><div align="right"><b>Buscar archivo </b></div></td>
		<td width="50%">
			<input type="file" name="file" />
		</td>
	</tr>	
	<tr>
		<td colspan="2"><div align="center"><input type="submit" class="button" value="Subir" /></div></td>
	</tr>
</table>
</form>
<?
}
?>


