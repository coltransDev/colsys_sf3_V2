<?
//echo $archivo->getCaTamano();
//
header('Content-Disposition: attachment; filename="'.$archivo->getCaNombre().'"');
header('Content-type: "'.$archivo->getCaTipo().'"');
header('Content-Length: '.$archivo->getCaTamano());

$fp = $archivo->getCaDatos();
if ($fp !== null) {
  fpassthru($fp);
}
exit();
?>