<?
use_helper("MimeType");
foreach( $data as $key=>$file ){
  
	$data[$key]['icon'] = mime_type_icon( $file['name'] , "32");
} 

echo json_encode( array( "files"=>$data, "total"=>count($data) ) );

?>