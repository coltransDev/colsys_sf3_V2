<?
$page_data = array(
		'success' => true,
		'total' => count($data),
		'data' => $data
	);

echo json_encode($page_data);
exit;
?>
?>