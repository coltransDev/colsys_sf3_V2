<?php
$data = $sf_data->getRaw( "data" );

//echo $comprobante->getCaConsecutivo();
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

header("Content-type:application/pdf");

// It will be called downloaded.pdf
header("Content-Disposition:inline;filename='downloaded.pdf'");

echo $data;

	exit();
?>