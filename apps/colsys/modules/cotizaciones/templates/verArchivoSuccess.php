<?
header('Content-Disposition: attachment; filename="'.$archivo->getCaNombre().'"');
header('content-type: "'.$archivo->getCaTipo().'"');
header('content-length: "'.$archivo->getCaTamano().'"');

$archivo->getCaDatos()->dump();
exit();
?>