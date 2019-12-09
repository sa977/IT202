<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 25%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}
</style>
</head>
<body>



<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<html>
<head></head>
<body>
	<form method="POST"/>
		Username:
		<input type="text" name="username" placeholder="Enter Username" />
		Password:
		<input type="password" name="password" placeholder="Enter Password"/>
		<input type="submit" value="Login"/>
	</form>
</body>
</html>
<?php

session_start();

	if(isset($_POST['username']) && isset($_POST['password'])){
		$user = $_POST['username'];
		$pass = $_POST['password'];
		
		try{
			require("config.php");
			
			$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
			$db = new PDO($conn_string, $username, $password);
			$stmt = $db->prepare("select username, password from `Users` where username = :username");
			$stmt->execute(array(":username"=>$user));
			print_r($stmt->errorInfo());
			$results = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if($results && count($results) > 0){
				$hash = password_hash($pass, PASSWORD_BCRYPT);
				if(password_verify($pass, $results['password'])){
					echo "Welcome, " . $results["username"];
					header("Location: projectgame.html");
					$_SESSION['user_id'] = $user->ID;
				}
				else{
					echo "Invalid password";
				}
			}
			else{
					echo "Invalid username";
			}
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}
?>
