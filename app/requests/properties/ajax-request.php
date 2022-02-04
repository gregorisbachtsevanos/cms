<?php 
	// $data['type'] = $_POST['type'];
	// $data['category'] = $_POST['category'];
	// $data['description'] = $_POST['description'];
	// $data['amount'] = $_POST['amount'];
	// $data['payedAmount'] = $_POST['payedAmount'];
	// $data['file'] = $_POST['file'];
	// echo json_encode($data);

	$data = array(
		'type' => $type,
		'category' => $_POST['category'],
		'description' => $_POST['description'],
		'amount' => $_POST['amount'],
		'payed_amount' => $_POST['payedAmount'],
		'file' => $_POST['file']
	);
	
	$db -> insert('transaction', $data);
	header("Location: ".$appURL);

?>