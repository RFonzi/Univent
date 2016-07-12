 <!DOCTYPE html>
 <html>
 <head>
 	<link rel="stylesheet" href="styles.css">
 </head>
 <body>
 	<h1>Join University</h1>

  <form name="joinUniv" action="joinUniv.php" method="post">

		<input type="hidden" name="joinUniv" value=""/>
		<li><label>University Name:</label>
		<input type="text" name="univName" size="25" />
 	  <input type="submit" value="CREATE UNIVERSITY" />
	</form>

<?php include 'functions.php';
  $unilist = getUniversities();

?>



</body>
</html>
