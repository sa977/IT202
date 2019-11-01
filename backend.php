<?php
function get_sample_users(){
	require('config.php');
	$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
	try{
		$db = new PDO($conn_string, $username, $password);
		$select_query = "select username, pin from `TestUsers`";
		$stmt = $db->prepare($select_query);
		$r = $stmt->execute();
		$response = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
	}

	catch(Exception $e){
		$response = "DB Error: " . $e;
	}
	return $response;
}

if(isset($_POST["type"])){
	$type = $_POST["type"];
	switch($type){
		case "db":
			$response = get_sample_users();
			break;
	}
	echo $response;
}
