<?

if( substr($archivo, -3,3)==".gz"){
    $nombreArchivo = substr($archivo,0, strlen($archivo)-3);
}else{
    $nombreArchivo = $archivo;
}

header('Content-Disposition: attachment; filename="'.basename($nombreArchivo).'"');
header('content-type: "'.Utils::mimetype(basename($nombreArchivo)).'"');
header('Content-Length: '.filesize($archivo));

if( substr($archivo, -3,3)==".gz"){
    readgzfile($archivo);
}else{
    readfile($archivo);
}
exit();

?>