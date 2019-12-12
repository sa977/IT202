<?php
function view_item($user){
	require("config.php");
	$conn_string = "";
	$db = new PDO($conn_string, $username, $password);
	
	$query = "select username, score from `Users` where username = :username";
	$stmt = $db->prepare($query);
	$r = $stmt->execute(array(":username"=>$user));
	$results = $stmt->fetch(PDO:FETCH_ASSOC);
	return $results;
}

function update_item($user, $score){
	require("config.php");
	$conn_string = "";
	$db = new PDO($conn_string, $username, $password);
	
	$query = "UPDATE Sample set score = :score where username = :username";
	$stmt = $db->prepare($query);
	$r = $stmt->execute(array(
		":score"=>$score));
	return $r > 0;
}
?>

<?php
	
	if(isset($_POST['username'])){
		update_item($_POST['score']);
	}
?>

<?php $row = view_item($user);?>
<?php if($row): ?>
	
	<form method="POST">
		<input type="hidden" name="username" value="<?php echo $row['username'];?>"/>
		<input type="text" name="score" value="<?php echo $row['score'];?>" />
		<input type="submit" value="Update"/>
	</form>
<?php endif; ?>
