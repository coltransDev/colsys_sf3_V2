<?
header('Content-Disposition: attachment; filename="'.$archivo->getCaNombre().'"');
$archivo->getCaDatos()->dump();
exit();
?>