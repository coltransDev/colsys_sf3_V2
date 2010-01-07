<?php
$referencia = str_replace(".","",$referencia);
header('Content-Disposition: attachment; filename="'.$referencia.'.xls"');
header('content-type: "text/plain"');

echo $salida;
exit();
?>
