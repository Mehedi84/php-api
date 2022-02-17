<?php
include_once('classes/connection.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
$data = json_decode(file_get_contents("php://input"));
$securityKey="123456789";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$allHeaders = getallheaders();
	if ($allHeaders['Content-Type'] == 'application/json') {
		if ($allHeaders['Authorization']==$securityKey) {
			if(!empty($data->id)){
				$sql = mysqli_query($conn, "SELECT `id` FROM `users` WHERE `id` = '".$data->id."'");
				$result = mysqli_num_rows($sql);
				if ($result <= 0){
					echo json_encode(
						array('message' => 'User Id Not Exits')
					);
				} else {
					if(!empty($data->user_name) && !empty($data->user_pass) && !empty($data->user_email) && !empty($data->user_group_id) && !empty($data->previlege)){
						$ticket_update_sql = mysqli_query($conn, "UPDATE `users` SET `user_name`='".$data->user_name."',`user_pass`='".$data->user_pass."',`user_email`='".$data->user_email."',`user_group_id`='".$data->user_group_id."',`previlege` = '".$data->previlege."' WHERE `id`='".$data->id."'");
						if($ticket_update_sql){
							echo json_encode(
								array('message' => 'Updated successfully!!!')
							);
						}else{
							echo json_encode(
								array('message' => 'Updated Not Found-------!')
							);
						}			
					}else{
						echo json_encode(
							array('message' => 'All field required')
						);
					}

				}		
			}else{
				echo json_encode(
					array('message' => '204 No User ID Not Allowed')
				);
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