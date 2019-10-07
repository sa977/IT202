<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function checkPasswords()
{
	if(isset($_POST['password']) && isset($_POST['confirm']))
	{
		
		if($_POST['password'] == $_POST['confirm'])
		{
			echo "<br>Passwords Matched!<br>";
		}
		
		else
		{
			echo "<br>Passwords didn't match!<br>";
		}
	}
}

function getName()
{
	if(isset($_POST['name']))
	{
		echo "<p>Hello, " . $_POST['name'] . "</p>";
	}
}
?>


<html>
<head></head>
<body>
<?php getName();?>
<form mode="POST" action="#">
<input name="name" type="text" placeholder="Username"/>
<input name="password" type="password" placeholder="Password"/>
<input name="confirm" type="password" placeholder="Re-enter Password"/>

<input type="submit" value="Submit"/>
</form>
</body>
</html>
<?php checkPasswords();?>
<?php
if(isset($_GET))
{
	echo "<br><pre>" . var_export($_GET, true) . "</pre><br>";
}
?>
 
