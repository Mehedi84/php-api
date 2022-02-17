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
			$id=$data->id;
			$sql = mysqli_query($conn, "SELECT id FROM users WHERE id = '".$id."'");
			$result = mysqli_num_rows($sql);
			if ($result <= 0) {
				echo json_encode(
					array('message' => 'User Id Not Exits')
				);
			} else {
				$up_sql = mysqli_query($conn, "DELETE FROM `users`  WHERE `id` ='".$id."'");
				if($up_sql){
					echo json_encode(
						array('message' => 'Record Deleted successfully!!!')
					);
				}else{
					echo json_encode(
						array('message' => 'Failed to delete Record!')
					);
				}
			}
		}else{
			echo json_encode(
				array('message' => 'Security Key Not Allowed')
			);
		}
	}else{
		echo json_encode(
			array('message' => 'Content Type Not Allowed')
		);
	}
}else{
	echo json_encode(
		array('message' => '405 Method Not Allowed')
	);
}
?>




