<?php include 'functions.php';
  session_start();
  $user = unserialize($_SESSION["user"]);
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
	<link href="https://fonts.googleapis.com/css?family=Fontdiner+Swanky" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
</head>
<body>
	<h1>Create Events</h1>

	<form name='createEvent' action='createEventsSuccess.php' method='post'>
		<input type='hidden' name='createEvent' value=''/>
		<li><label>time: HHMMSS</label>
		<input type='text' name='time' size='25' />
		<li><label>date: 20YYMMDD</label>
		<input type='text' name='date' size='25' />
		<li><label>Event Name</label>
		<input type='text' name='name' size='25' />
		<li><label>Category</label><?php
    echo "<select name='category' id='category'>\n";
    echo "<option value='public' selected>Public</option>\n";
    echo "<option value='private'>Private</option>\n";
    if(getUserLevel($user) == 2){
      echo "<option value='RSO'>RSO</option>\n";
    }
  echo "</select>\n";?>
		<li><label>Description</label>
		<textarea type='text' id='description' name='description' rows='8' cols='20'></textarea>
		<li><label>Contact Phone</label>
		<input type='text' name='contactPhone' size='25' />
		<li><label>Event Type</label>
		<input type='text' name='type' size='25' />
		<li><label>Location Name</label>
		<input type='text' name='loc' size='25' />
		<li><label>Latitude</label>
		<input type='text' name='lat' size='25' />
		<li><label>Longitude</label>
		<input type='text' name='long' size='25' />

		<input type='submit' value='CREATE EVENT' />
	</form>

	<form action="dashboard.php">
		<input type="hidden" name="returnFromCreateEvent" value=""/>
		<input type="submit" value="RETURN TO DASH" />
	</form>


</body>
</html>
