<?php include 'functions.php';
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>RSO Events</h1>

	<form>

	<?php

		//get current user logged in
		$user = unserialize($_SESSION["user"]);

		$arrayOfData = getRSOEvents($user);
		$_SESSION["Events"] = serialize($arrayOfData);

		$html_table = '<table border="1" cellspacing="0" cellpadding="2" width="100%"><tr><th>Event Name</th><th>Date</th><th>Event Time</th></tr>';

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
