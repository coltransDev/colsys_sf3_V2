<?
header('Content-Disposition: attachment; filename="'.$archivo->getCaHeaderFile().'"');
header('content-type: "'.Utils::mimetype($archivo->getCaHeaderFile()).'"');
header('Content-Length: '.$archivo->getCaFilesize());



$fp = $archivo->getCaContent();
if ($fp !== null) {
  fpassthru($fp);
}

exit();

?>