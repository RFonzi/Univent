<!DOCTYPE html>
<html>

<?php include 'functions.php';
 
	
?>
<head>
	<link rel="stylesheet" href="styles.css">
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
		<li><label>Category</label>
		<input type='text' name='category' size='25' />
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




</body>
</html>