<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php include 'functions.php';
	createUser("test", "test", "testemail");
	$user = getUser("test", "test");
	echo $user->username;
?>
	<div id="pageWrapper">
		<div id="header">
			<p id="siteTitle">Univent</p>
			<p id="signifier">Welcome, <?php print $user->username ?></p>
		</div>

	<select>
		<option value="viewAll">View All Events</option>
		<option value="viewPublic">View Public Events</option>
		<option value="viewPrivate">View Private Events</option>
		<option value="viewRSO">View RSO Events</option>
		<option value="joinRSO">Join RSO</option>
		<option value="createRSO">Create RSO</option>
		<option value="createEvent">Create Event</option>
		<option value="createUniv">Create University</option>
	</select>
	
	</div>
</body>
</html>

//change views and functionality based off of dropdown select//
//check privileges
//create table of size 5; next and previous selectors
//reload page