<?php
include_once('classes/connection.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
$securityKey="123456789";
$data = json_decode(file_get_contents("php://input"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$allHeaders = getallheaders();
	if ($allHeaders['Content-Type'] == 'application/json') {
		if ($allHeaders['Authorization']==$securityKey) {
			if (!empty($data->id)) {
				$sql = mysqli_query($conn, "SELECT * FROM `users` WHERE `id`='".$data->id."'");
			}else{
				$sql = mysqli_query($conn, "SELECT * FROM `users`");
			}
			$num = mysqli_num_rows($sql);
			if ($num > 0) {
				$users = array();

				while ($row = mysqli_fetch_array($sql)) {
					extract($row);
					$uaerAll = array(
						'id'             => $id,
						'user_name'       => $user_name,
						'user_pass'       => $user_pass,
						'user_email'    => $user_email
					);
					array_push($users, $uaerAll);
				}
				echo json_encode($users);

			} else {
				echo json_encode(
					array('message' => 'Data Not Found')
				);
			}
		}else{
			echo json_encode(
				array('message' => 'Content Type Not Allowed')
			);
		}
	}else{
		echo json_encode(
			array('message' => 'Security Key Not Allowed')
		);
	}
}else{
	echo json_encode(
		array('message' => '405 Method Not Allowed')
	);
}
?>