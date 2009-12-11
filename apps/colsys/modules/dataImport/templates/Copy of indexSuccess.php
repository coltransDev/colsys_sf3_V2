<?
use_helper("Javascript","Object");

echo submit_to_remote(array("url"=>"dataimport/importfile", 
									"update"=>"resultadoImport",
									"with"=>"'filename='+document.getElementById('archivo').value",
									'loading'  => visual_effect('appear', 'indicator'),
								    'complete' => visual_effect('fade', 'indicator')
									)
									)
?>

<table width="40%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<th scope="col">&nbsp;</th>
		<th scope="col">&nbsp;</th>
	</tr>
	<tr>
		<td>Archivo</td>
		<td><?=input_file_tag("archivo")?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><?echo submit_tag('Cargar el Archivo');?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><div id="resultadoImport"></div></td>
	</tr>
</table>
