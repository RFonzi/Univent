<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'functions.php';

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
		if($userpriv >= 0 && $userpriv != 3){
			echo "<option value='viewAll'>View All Events</option>\n";
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
	echo "<input type='submit' name='submit'\>\n";
	echo "</form>\n";
	?>

	<?php


			if($_POST['list']=="viewAll"){
				echo "<form action='viewAllEvents.php' method='post' name='redirectCreateEvent'>";
				echo "<input type='hidden' name='user' value='" . $user . "'>";
				echo "</form>";
			}
			if($_POST['list']=="viewPublic"){
				echo "<form action='viewPublicEvents.php' method='post' name='redirectCreateEvent'>";
				echo "<input type='hidden' name='user' value='" . $user . "'>";
				echo "</form>";
			}

			if($_POST['list']=="viewPrivate"){
				echo "<form action='viewPrivateEvents.php' method='post' name='redirectCreateEvent'>";
				echo "<input type='hidden' name='user' value='" . $user . "'>";
				echo "</form>";
			}

			if($_POST['list']=="viewRSO"){
				echo "<form action='viewRSOevents.php' method='post' name='redirectCreateEvent'>";
				echo "<input type='hidden' name='user' value='" . $user . "'>";
				echo "</form>";
			}


			if($_POST['list']=="joinRSO"){
				echo "<form action='joinrso.php' method='post' name='redirectCreateEvent'>";
				echo "<input type='hidden' name='user' value='" . $user . "'>";
				echo "</form>";
			}

			if($_POST['list']=="createRSO"){
				echo "<form action='createrso.php' method='post' name='redirectCreateEvent'>";
				echo "<input type='hidden' name='user' value='" . $user . "'>";
				echo "</form>";
			}

				//new page for create rso redirect here
			if($_POST['list']=="createEvent"){
				echo "<form action='createEvents.php' method='post' name='redirectCreateEvent'>";
				echo "<input type='hidden' name='user' value='" . $user . "'>";
				echo "</form>";
				//new page for create event redirect here
			}
			if($_POST['list']=="createUniv"){
				echo "<form action='createUniv.php' method='post' name='redirectCreateEvent'>";
				echo "<input type='hidden' name='user' value='" . $user . "'>";
				echo "</form>";
			}
			if($_POST['list']=="joinUniv"){
				echo "<form action='joinUniv.php' method='post' name='redirectCreateEvent'>";
				echo "<input type='hidden' name='user' value='" . $user . "'>";
				echo "</form>";
			}


	?>

	</div>
</body>
<script type="text/javascript">

if(typeof redirectCreateEvent != "undefined"){
  document.redirectCreateEvent.submit();
}
else{
  takemeback();
}
</script>
</html>
