<?php include 'functions.php';
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
	 <link href="https://fonts.googleapis.com/css?family=Galada" rel="stylesheet">
</head>
<body>
	<?php
		$events = unserialize($_SESSION["Events"]);
		print_r($events);
		
		$index = $_GET["index"];
		
		$eventObj = $events[$index];
		
		$comments = getComments($eventObj->time, $eventObj->name);
		$_SESSION["IndivEvent"] = serialize($eventObj);
	?>
	<h1><?php echo $eventObj->e_name; ?></h1>

//display all attributes of event

//buttons for up/down vote

<form name="leaveComment" action="leaveCommentSuccess.php" method="post">
<input type="hidden" name="leaveComment" value="<?php echo $index; ?>"/>

<li><label>Comments</label>
<textarea type="text" id="comment" name="comment" rows="8" cols="50"></textarea>
<input type="submit" value="Comment!"/>
</form>

<iframe
 width="450"
 height="250"
 frameborder="0" style="border:0"
 src="https://www.google.com/maps/embed/v1/search?key=AIzaSyAV7hEjYqgMNQ4Xn2hQnCBluRK-8A_ejro
 &q= <?php echo $eventObj->latitude.",". $eventObj->longitude; ?>
 &zoom=18">
</iframe>



	<form action="dashboard.php">
		<input type="hidden" name="returnFromTable" value=""/>
		<input type="submit" value="RETURN TO DASH" />
	</form>
</body>
</html>
