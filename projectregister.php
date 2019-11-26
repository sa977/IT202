<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<html>
<head>
<script>
function checkPasswords(form){
	let isOk = form.password.value == form.confirm.value;
	if(!isOk){ alert("Passwords don't match");}
	return isOk;
}
</script>
</head>
<body>
	<form method="POST" onsubmit="return checkPasswords(this);"/>
		<input type="text" name="username" placeholder="Enter Username"/>
		<input type="password" name="password" placeholder="Enter Password"/>
		<input type="password" name="confirm" placeholder="Re-enter Password"/>
		<input type="submit" value="Register"/>
	</form>
</body>
</html>
<?php
	if(isset($_POST['username']) 
		&& isset($_POST['password'])
		&& isset($_POST['confirm'])){
			
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$confirm = $_POST['confirm'];
		if($pass != $confirm){
				echo "Passwords don't match";
				exit();
		}
	
		try{
		
			$hash = password_hash($pass, PASSWORD_BCRYPT);
			require("config.php");
			
			$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
			$db = new PDO($conn_string, $username, $password);
			$stmt = $db->prepare("INSERT into `Users` (`username`, `password`) VALUES(:username, :password)");
			$result = $stmt->execute(
				array(":username"=>$user,
					":password"=>$hash
				)
			);
			print_r($stmt->errorInfo());
			
			echo var_export($result, true);
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}
?>
