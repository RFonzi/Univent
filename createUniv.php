<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Create University</h1>
	
	<form name="createUniv" action="createUnivSuccess.php" method="post">
	
		<input type="hidden" name="createUniv" value=""/>
		<li><label>University Name:</label>
		<input type="text" name="univName" size="25" />
		<li><label>Location:</label>
		<input type="text" name="location" size="25" />
		<li><label>Description</label>
		<textarea type="text" id="description" name="description" rows="8" cols="50"></textarea>
		<li><label>Pictures:</label>
		<input type="text" name="pictures" size="25" />
		
		<input type="submit" value="CREATE UNIVERSITY" />
	</form>




</body>
</html>