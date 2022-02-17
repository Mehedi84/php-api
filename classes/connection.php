<?php 
// class database {
// 	private $host = 'localhost';
// 	private $db_name = 'ihelp_crm';
// 	private $username = 'root';
// 	private $password = 'iHelpBD@2017';
// 	public $conn;
// 	function __construct(){
// 		$this->conn = null;
// 		try {
// 			$this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
// 			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 		} catch(PDOException $e) {
// 			echo 'Connection Error: ' . $e->getMessage();
// 			die();
// 		}
// 	}
// }
$conn = new mysqli("localhost", "root", "","api");

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>