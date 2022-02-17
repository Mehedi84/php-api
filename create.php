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
			if(!empty($data->user_name) && !empty($data->user_pass) && !empty($data->user_email) && !empty($data->user_group_id) && !empty($data->previlege)){

				$create_ticket_sql = mysqli_query($conn, "INSERT INTO `users`(`user_name`, `user_pass`, `user_email`, `user_group_id`, `previlege`) VALUES ('".$data->user_name."','".$data->user_pass."','".$data->user_email."','".$data->user_group_id."','".$data->previlege."')");
				if($create_ticket_sql){
					echo json_encode(
						array('message' => 'Created successfully!!!')
					);
				}else{
					echo json_encode(
						array('message' => 'Not Created!')
					);
				}
			}else{
				echo json_encode(
					array('message' => 'All field required')
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