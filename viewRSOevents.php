<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<h1>Private Events</h1>
	
	<?php include 'functions.php';
		
		createUser("test","test","email@.com");
		$user = getUser("test","test");
		createEvent(001333, 00002233,"justin","RSO","desc","phone","email","xmas","loc7 name unique",22.0,23.0,$user);
		createEvent(001332, 00002233,"justin","RSO","desc","phone","email","xmas","loc8 name unique",22.0,23.0,$user);
		createEvent(001331, 00002233,"justin","RSO","desc","phone","email","xmas","loc9 name unique",22.0,23.0,$user);
		
		$arrayOfData = getRSOEvents($user);
		
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