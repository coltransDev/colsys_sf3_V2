<?php
$page_data = array(
		'success' => true,
		'total' => $total,
		'data' => $data
	);

echo json_encode($page_data);
exit;
?>