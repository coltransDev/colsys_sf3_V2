<?

header('Content-Disposition: attachment; filename="'.$archivo->getCaNombre().'"');
header('content-type: "'.$archivo->getCaTipo().'"');
//header('content-length: "'.$archivo->getCaTamano().'"');


$fp = $archivo->getCaDatos();
if ($fp !== null) {
  fpassthru($fp);
}


exit();
?>