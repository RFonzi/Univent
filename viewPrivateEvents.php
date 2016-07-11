<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Private Events</h1>
	
	<?php include 'functions.php';
		
		createUser("test","test","email@.com");
		$user = getUser("test","test");
		createEvent(002333, 00002233,"justin","private","desc","phone","email","xmas","loc3 name unique",22.0,23.0,$user);
		createEvent(002332, 00002233,"justin","private","desc","phone","email","xmas","loc4 name unique",22.0,23.0,$user);
		createEvent(002331, 00002233,"justin","private","desc","phone","email","xmas","loc5 name unique",22.0,23.0,$user);
		
		$arrayOfData = getPrivateEvents($user);
		
		$html_table = '<table border="1 cellspacing="0" cellpadding="2""><tr><th>Event Name</th><th>Location</th><th>Event Time</th></tr>';
		
				
			
			for($i=0;$i<count($arrayOfData);$i++)
			{
				$html_table .="<tr><td>".$arrayOfData[$i]->e_name."</td><td>".$arrayOfData[$i]->date."</td><td>".$arrayOfData[$i]->time."</td></tr>";
			}
		
		
		$html_table .='</table>';
		
		echo $html_table;
	
	?>
	
	<form action="dashboard.php">
		<input type="hidden" name="returnFromTable" value=""/>
		<input type="submit" value="RETURN TO DASH" />
	</form>


</body>
</html>