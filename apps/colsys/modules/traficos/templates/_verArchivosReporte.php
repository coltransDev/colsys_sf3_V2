<?
use_helper("MimeType");


?>
<ul>
<?
foreach( $files as $file ){
	$fileIdx = $user->addFile( $file );
	?>
	<li>
		<?=mime_type_icon( basename($file) )?> 
		<a href="#" onclick="popup('<?=url_for("traficos/fileViewer?idx=".$fileIdx."&token=".md5(time().basename($file)))?>')"><?=basename( $file )?></a> 
		
		
		<a href="#" onclick="eliminarArchivos('<?=$reporte->getCaIdreporte()?>', '<?=$fileIdx?>')"><?=image_tag("16x16/delete.gif")?></a>
		
	</li>
	<?
	echo "</li>";
	
}

$token = md5(time());
?>
</ul>


<form action="<?=url_for("traficos/cargarArchivo")?>"  target="uploadFrame" enctype="multipart/form-data" method="post" />
	<input type="hidden" name="idreporte" value="<?=$reporte->getCaIdreporte()?>" />
<table width="100%" border="0" class="tableForm">
	
	<tr>
		<td width="50%"><div align="right"><b>Buscar archivo </b></div></td>
		<td width="50%">
			<input type="file" name="file" />
		</td>
	</tr>
	<?
	
	?>
	
	
	<?
	
	?>
	<tr>
		<td colspan="2"><div align="center"><input type="submit" class="button" value="Subir" /></div></td>
	</tr>
</table>
</form>


