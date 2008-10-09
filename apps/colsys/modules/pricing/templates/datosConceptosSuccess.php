<?
$arr = array( "totalCount"=>count( $conceptos ), "root"=>$conceptos  );
echo json_encode($arr);
exit;
?>