<?
use_helper("Javascript","Object");

/*
echo submit_to_remote(array("url"=>"dataimport/importfile", 
									"update"=>"resultadoImport",
									"with"=>"'filename='+document.getElementById('archivo').value",
									'loading'  => visual_effect('appear', 'indicator'),
								    'complete' => visual_effect('fade', 'indicator')
									)
									);
*/

$directory='C:\\Desarrollo\\Apache2\\htdocs\\links';
$files = sfFinder::type('file')->maxDepth(0)->in($directory);

?>

<table width="40%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<th width="9%" scope="col">Nombre del Archivo</th>
	</tr>
	<?
	foreach ($files as $file ) {
		
	?>
	<tr>
		<td><div align="left"><?=$file."\n"?></div></td>
	</tr>
	<?
		
	}
	?>
	<tr>
		<td><div id="resultadoImport"></div></td>
	</tr>
</table>
