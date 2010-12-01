<?php
$fileName = "notificacion_".date('YmdHi');
header('Content-Disposition: attachment; filename="'.$fileName.'.txt"');
header('content-type: "text/plain"');

echo $salida;
exit();
?>
