<?php include 'functions.php';
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
	<link href="https://fonts.googleapis.com/css?family=Fontdiner+Swanky" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
</head>
<body>
	<h1>Public Events</h1>

	<form>
	<?php

		//get current user logged in
		$user = unserialize($_SESSION["user"]);

		/*createEvent(001133, 00002233,"justin","public","desc","phone","email","xmas","loc name unique",22.0,23.0,$user);
		createEvent(001132, 00002233,"justin","public","desc","phone","email","xmas","loc1 name unique",22.0,23.0,$user);
		createEvent(001131, 00002233,"justin","public","desc","phone","email","xmas","loc2 name unique",22.0,23.0,$user);*/

		$arrayOfData = getPublicEvents();
		$_SESSION["Events"] = serialize($arrayOfData);

		$html_table = '<table border="1" cellspacing="0" cellpadding="2" width="100%"><tr><th>Event Name</th><th>Location</th><th>Event Time</th></tr>';



			for($i=0;$i<count($arrayOfData);$i++)
			{
				$html_table .="<tr><td><a href='viewIndividualEvent.php?index=$i'>".$arrayOfData[$i]->e_name."</a></td><td>".$arrayOfData[$i]->date."</td><td>".$arrayOfData[$i]->time."</td></tr>";
			}


		$html_table .='</table>';

		echo $html_table;

	?>
	</form>

	<form action="dashboard.php">
		<input type="hidden" name="returnFromTable" value=""/>
		<input type="submit" value="RETURN TO DASH" />
	</form>


</body>
</html>
