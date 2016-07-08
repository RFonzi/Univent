<!DOCTYPE html>
<html>
<head>
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
	
	
	
	<select name="list" id="list" accesskey="target">
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
	<input type=button value="Go" onclick="makeTheTable()"/>
	
	<h1>This is where the table goes</h1>
	
	<?php
		function makeTheTable()
		{
			if($_POST['list']==viewAll)
				$arrayOfData = getAllEvents($user);
			if($_POST['list']==viewPublic)
				$arrayOfData = getPublicEvents($user);
			if($_POST['list']==viewPrivate)
				$arrayOfData = getPrivateEvents($user);
			if($_POST['list']==viewRSO)
				$arrayOfData = getRSOevents($user);
				
			//createTable($arrayOfData);
				
			if($_POST['list']==joinRSO)
				$didJoin = joinRSO($user);
				//do confirmation here
			if($_POST['list']==createRSO)
				$arrayOfData = ($user);
			if($_POST['list']==createEvent)
				$arrayOfData = getAllEvents($user);
			if($_POST['list']==createUniv)
				$arrayOfData = getAllEvents($user);
			
		}
		
		
	?>
	
	</div>
</body>
</html>

