<?
header('Access-Control-Allow-Origin: *'); 
echo json_encode( $sf_data->getRaw('responseArray') );
exit; 
?>