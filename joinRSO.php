<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
	 <link href="https://fonts.googleapis.com/css?family=Galada" rel="stylesheet">
</head>
<body>
	<h1>Join RSO</h1>
	
	<?php include 'functions.php';
		$arrayOfData = getRSO($user);
		
		$html_table = '<table border="1 cellspacing="0" cellpadding="2""><tr><th>RSO Id</th><th>RSO Name</th><th>Description</th></tr>';
		
				
			
			for($i=0;$i<count($arrayOfData);$i++)
			{
				$html_table .="<tr><td><a href='dashboard.php'>".$arrayOfData[$i]->rid."</a></td><td>".$arrayOfData[$i]->name."</td><td>".$arrayOfData[$i]->description."</td></tr>";
			}
		
		
		$html_table .='</table>';
		
		echo $html_table;
	
	?>




</body>
</html>