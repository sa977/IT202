//session
//check
//destroy
//test


//Milestone template

<form>
<input type="text" name="username"/>
<input type="password" name="password"/>
<input type="submit" value="Login"/>

<?php
        if(isset($response)){
                echo $response;
        }
        if(isset($_SESSION['response'])){
                echo $_SESSION['response'];
        }
?>
<!--somewhere-->
<?php

if (isset($_POST['something'])){
	$something = $_POST['something']; //get values
        require("config.php');
        $db = new PDO(blah bla blah)    //connect to DB
        //check for user and/or password
        $db->prepare
        $stmt->bindParam
        $stmt->execute
        $res? = $stmt->fetch(PDO type);

        //validate password if not already done
        //return error or user data

        return $response                //can also echo instead of return
}

?>
