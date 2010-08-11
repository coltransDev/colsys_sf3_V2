<?

header('Content-Disposition: attachment; filename="'.basename($archivo).'"');
header('content-type: "'.Utils::mimetype(basename($archivo)).'"');
header('Content-Length: '.filesize($archivo));


readfile($archivo);
exit();

?>