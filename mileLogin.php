<!DOCTYPE html>  
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
	$response = "nothing";
	switch($type){
		case "db":
			$response = get_sample_users();
			break;
	}
	echo $response;
}


ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function checkPasswords(){
	if(isset($_POST['password']) && isset($_POST['confirm'])){
		if($_POST['password'] == $_POST['confirm']){
			echo "<br>Welcome Back!<br>";
		}
		else{
			echo "<br>Passwords didn't match!<br>";
		}
	}
}
?>
<html>
<head>
<script>
function validate(){
	var form = document.forms[0];
	var password = form.password.value;
	var conf = form.confirm.value;
	console.log(password);
	console.log(conf);
	let pv = document.getElementById("validation.password");
	let succeeded = true;

	if(password == conf){
		
		pv.style.display = "none";
		form.confirm.className= "noerror";	
	}

	else{
		pv.style.display = "block";
		pv.innerText = "Passwords don't match";
		//form.confirm.focus();
		form.confirm.className = "error";
		//form.confirm.style = "border: 1px solid red;";
		succeeded = false;
	}

	return succeeded;	
}

</script>
<style>
input { border: 1px solid black; }
.error {border: 1px solid red;}
.noerror {border: 1px solid black;}
</style>

</head>
<body>
<div style="margin-left: 50%; margin-right:50%;">
<form method="POST" action="#" onsubmit="return validate();">

<input name="Username" type="name" placeholder="Username"/>
<span id="validation.name" style="display:none;"></span>

<input type="password" name="password" placeholder="Enter Password"/>
<input type="password" name="confirm" placeholder="Re-Enter Password"/>
<span style="display:none;" id="validation.password"></span>

<input type="submit" value="Log In"/>
</form>
</div>
</body>
</html>

<?php checkPasswords();?>


<?php
if(isset($_POST)){
	echo "<br><pre>" . var_export($_POST, true) . "</pre><br>";
}
?>
