<?php
header('Content-Disposition: attachment; filename="'.$iddoc.'.txt"');
header('content-type: "text/plain"');

echo $salida;
exit();
?>
