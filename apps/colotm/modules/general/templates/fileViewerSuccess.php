<?

header ("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Length: ' . filesize($name));
header('Content-Disposition: attachment; filename="' . basename($name)).'"';
	
readfile($name);  
exit;
?>