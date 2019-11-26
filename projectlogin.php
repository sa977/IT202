<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<html>
<head></head>
<body>
	<form method="POST"/>
		<input type="text" name="username" placeholder="Enter Username" />
		<input type="password" name="password" placeholder="Enter Password"/>
		<input type="submit" value="Login"/>
	</form>
</body>
</html>
<?php
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
					header("Location: pong.html");
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
