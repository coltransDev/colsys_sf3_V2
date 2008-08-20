<?
$arr = array( "totalCount"=>count( $cotizaciones ), "cotizaciones"=>$cotizaciones  );
echo json_encode($arr);
exit;
?>