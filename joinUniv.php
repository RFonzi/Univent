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

<?php
if(isset($_POST["univName"])){
  $user = unserialize($_SESSION["user"]);
  $uniname = $_POST["univName"];

  if(joinUniversity($uniname, $user)){
    $_SESSION["user"] = serialize($user);
    echo "<script>document.location = 'dashboard.php';</script>";
  }
  else{
    echo "Failed to join " . $uniname . ".";
  }
}
?>

 	<h1>Join University</h1>

  <form name="joinUniv" action="joinUniv.php" method="post">

		<input type="hidden" name="joinUniv" value=""/>
		<li><label>University Name:</label>
		<input type="text" name="univName" size="25" />
 	  <input type="submit" value="JOIN UNIVERSITY" />
	</form>

<?php
  $arrayOfData = getUniversity();

  $html_table = '<table border="1" cellspacing="0" cellpadding="2" width="100%"><tr><th>University Name</th><th>Location</th><th>Description</th></tr>';



    for($i=0;$i<count($arrayOfData);$i++)
    {
      $html_table .="<tr><td>".$arrayOfData[$i]->name."</a></td><td>".$arrayOfData[$i]->location."</td><td>".$arrayOfData[$i]->description."</td></tr>";
    }


  $html_table .='</table>';

  echo $html_table;


?>

	<form action="dashboard.php">
		<input type="hidden" name="returnFromJoinUniv" value=""/>
		<input type="submit" value="RETURN TO DASH" />
	</form>

</body>
</html>
