<?
$arr = array( "totalCount"=>count( $reportes ), "reportes"=>$reportes  );
echo json_encode($arr);
exit;
?>