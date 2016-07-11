<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
</head>
<body>
<?php include 'functions.php';
	createUser("test", "test", "testemail");
	
	//get current user logged in
	$user = getUser("test", "test");
?>
	<div id="pageWrapper">
		<div id="header">
			<p id="siteTitle">Univent</p>
			<p id="signifier">Welcome, <?php print $user->username ?></p>
		</div>
	
	
	<form name="menuOp" method="post" onsubmit="location.reload()">
	<select name="list">
		<option value='none' selected>Choose your destiny.</option>
		<option value="viewAll">View All Events</option>
		<option value="viewPublic">View Public Events</option>
		<option value="viewPrivate">View Private Events</option>
		<option value="viewRSO">View RSO Events</option>
		<option value="joinRSO">Join RSO</option>
		<option value="createRSO">Create RSO</option>
		<option value="createEvent">Create Event</option>
		<option value="createUniv">Create University</option>
	</select>
	<input type='submit' name='submit'\>
	</form>
	
	
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

