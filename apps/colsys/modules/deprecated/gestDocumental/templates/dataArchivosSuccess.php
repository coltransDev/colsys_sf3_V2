<?
use_helper("MimeType");

$files = $sf_data->getRaw('files');

foreach( $files as $key=>$file ){
	  
	$files[$key]['icon'] = mime_type_icon( $file['name'] , "32");
} 

echo json_encode(array("files"=>$files, "count"=>count($files), "success"=>true));
exit; 
?>