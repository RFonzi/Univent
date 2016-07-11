<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
</head>
<body>
<?php include 'functions.php';
	createUser("test", "test", "testemail");

	//get current user logged in
	$user = stringToUser($_POST["user"]);
?>
	<div id="pageWrapper">
		<div id="header">
			<p id="siteTitle">Univent</p>
			<p id="signifier">Welcome, <?php print $user->username ?></p>
		</div>


	<?php
		$userpriv = getUserLevel($user->sid);
		echo "<form name='menuOp' method='post' onsubmit='location.reload()'>\n";
		echo "<input type='hidden' name='user' value='" . $user . "'>\n";
		echo "<select name='list'>\n";
		echo "<option value='none' selected>Choose your destiny.</option>\n";
		if($userpriv >= 0 && $userpriv != 4){
			echo "<option value='viewAll'>View All Events</option>\n";
			echo "<option value='viewPublic'>View Public Events</option>\n";
			if($userpriv == 0){
				echo "<option value='joinUni'>Start attending a university</option>\n";
			}
		}
		if($userpriv > 1 && $userpriv != 4){
			echo "<option value='viewPrivate'>View Private Events</option>\n";
			echo "<option value='viewRSO'>View RSO Events</option>\n";
			echo "<option value='joinRSO'>Join RSO</option>\n";
			echo "<option value='createRSO'>Create RSO</option>\n";
			echo "<option value='createEvent'>Create Event</option>\n";
		}
		if($userpriv == 4){
			echo "<option value='createUniv'>Create University</option>\n";
		}
	echo "</select>\n";
	echo "<input type='submit' name='submit'\>\n";
	echo "</form>\n";
	?>


	<h1>This is where the table goes</h1>

	<?php


			if($_POST['list']=="viewAll"){
				echo "test";
			}	//$arrayOfData = getAllEvents($user->sid);
			if($_POST['list']=="viewPublic")
				echo "test1";
				//$arrayOfData = getPublicEvents($user);
			if($_POST['list']=="viewPrivate")
				echo "test2";
				//$arrayOfData = getPrivateEvents($user);
			if($_POST['list']=="viewRSO")
				echo "test3";
				//$arrayOfData = getRSOevents($user);

			//createTable($arrayOfData);

			if($_POST['list']=="joinRSO")
				echo "test4";
				//$didJoin = joinRSO($user);
				//do confirmation here
			if($_POST['list']=="createRSO")
				echo "test5";
				//new page for create rso redirect here
			if($_POST['list']=="createEvent")
				echo "<form action='createEvents.php' method='post' name='redirectCreateEvent'>";
				//new page for create event redirect here


			if($_POST['list']=="createUniv")
				//$userlvl = getUserLevel($user->sid);
				//if($userlvl==3)
					//new page for create univ redirect here
				//else echo "Credentials not acquired."




	?>

	</div>
</body>
</html>
