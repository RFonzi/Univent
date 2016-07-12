<?php include "functions.php";
session_start();
 ?>

<!DOCTYPE html>
<html>
<style>
	h2 {
		margin-top: 6%;
	}
	form {
		margin-top: 30%;
	}
</style>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
<?php

	//get current user logged in
	$user = unserialize($_SESSION["user"]);

?>
	<div>
		<h1 style="float: left">Univent</h1>
		<h2 style="float: right">Welcome, <?php print $user->username ?></h2>
	</div>
	<hr />

	<form>
	<?php
		$userpriv = getUserLevel($user->sid);
		echo "<form action='#'>\n";
		echo "<select name='list' id='list'>\n";
		echo "<option value='none' selected>Choose your destiny.</option>\n";
		if($userpriv >= 0 && $userpriv != 3){
			echo "<option value='viewPublic'>View Public Events</option>\n";
			if($userpriv == 0){
				echo "<option value='joinUniv'>Start attending a university</option>\n";
			}
		}
		if($userpriv > 1 && $userpriv != 3){
			echo "<option value='viewPrivate'>View Private Events</option>\n";
			echo "<option value='viewRSO'>View RSO Events</option>\n";
			echo "<option value='joinRSO'>Join RSO</option>\n";
			echo "<option value='createRSO'>Create RSO</option>\n";
			echo "<option value='createEvent'>Create Event</option>\n";
		}
		if($userpriv == 3){
			echo "<option value='createUniv'>Create University</option>\n";
		}
	echo "</select>\n";
	echo "</form>\n";
	?>
		<input type="button" value="Submit" onclick="switchPage($('#list option:selected').val());"/>
	</form>

</body>
<script type="text/javascript">

	function switchPage(value){
		console.log("entered function");

		if(value == "viewPublic"){
			console.log(value);
			document.location = "viewPublicEvents.php";
		}
		else if(value == "viewPrivate"){
			console.log(value);
			document.location = "viewPrivateEvents.php";
		}
		else if(value == "viewRSO"){
			console.log(value);
			document.location = "viewRSOevents.php";
		}
		else if(value == "joinRSO"){
			console.log(value);
			document.location = "joinRSO.php";
		}
		else if(value == "createRSO"){
			console.log(value);
			document.location = "createrso.php";
		}
		else if(value == "createEvent"){
			console.log(value);
			document.location = "createEvents.php";
		}
		else if(value == "createUniv"){
			console.log(value);
			document.location = "createUniv.php";
		}
		else if(value == "joinUniv"){
			console.log(value);
			document.location = "joinUniv.php";
		}
	}
</script>
</html>
