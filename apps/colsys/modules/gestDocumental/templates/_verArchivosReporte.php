<?
use_helper("MimeType", "Popup");
$fileIdx = 0;

?>
<ul>
<?
foreach( $files as $file ){
	$user->addFile( $file, $fileIdx );
	echo "<li>".mime_type_icon( basename($file) )." ".link_popup(basename( $file ),"gestDocumental/fileViewer?idx=".$fileIdx."&token=".md5(time().basename($file)),"800","600" );
	echo "&nbsp;&nbsp;".link_to_remote(image_tag("16x16/delete.gif"), array('update'   => '',
																		'url'      => "gestDocumental/eliminarArchivo?idx=".$fileIdx,
																		'loading'  => visual_effect('appear', 'indicator'),
																		'complete' => visual_effect('fade', 'indicator')."actualizar( '".$reporte->getCaIdreporte()."' );",
																		'confirm' => "Esta seguro que desea borrar el archivo?"
																		) );
	echo "</li>";
	$fileIdx++;
}

$token = md5(time());
?>
</ul>
<div id="formArchivo<?=$token?>"></div>

<?
echo link_to_remote(image_tag("22x22/up.gif")."Cargar archivo", array('update'   => 'formArchivo'.$token,
																		'url'      => "gestDocumental/cargarArchivoForm?reporteId=".$reporte->getCaIdreporte()."&token=".md5(time()),
																		'loading'  => visual_effect('appear', 'indicator'),
																		'complete' => visual_effect('fade', 'indicator'),
																		'script'=>true
																		) );


?>