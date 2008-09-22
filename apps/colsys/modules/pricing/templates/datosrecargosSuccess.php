<?
$arr = array( "totalCount"=>count( $recargos ), "recargos"=>$recargos  );
echo json_encode($arr);
exit;
?>