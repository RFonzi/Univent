<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Create RSO</h1>
	
	<form name="createRSO" action="createEventsSuccess.php" method="post">
		<input type="hidden" name="createRSO" value=""/>
		<li><label>RSO Name:</label>
		<input type="text" name="rsoName" size="25" />
		<li><label>University Name:</label>
		<input type="text" name="university" size="25" />
		<li><label>Description</label>
		<textarea type="text" id="description" name="description" rows="8" cols="50"></textarea>
		<input type="submit" value="CREATE RSO" />
	</form>




</body>
</html>