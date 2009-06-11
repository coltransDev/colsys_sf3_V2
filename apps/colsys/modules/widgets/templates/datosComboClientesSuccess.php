<?
$arr = array( "totalCount"=>count( $clientes ), "clientes"=>$clientes  );
echo json_encode($arr);
exit;
?>