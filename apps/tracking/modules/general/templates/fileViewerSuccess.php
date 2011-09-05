<?


if( substr($name, -3,3)==".gz"){
    $nombreArchivo = substr($name,0, strlen($name)-3);
}else{
    $nombreArchivo = $name;
}

header ("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Length: ' . filesize($nombreArchivo));
header('Content-Disposition: attachment; filename="' . basename($nombreArchivo)).'"';
	

if( substr($name, -3,3)==".gz"){
    readgzfile($name);  
}else{
    readfile($name);  
}

exit;
?>