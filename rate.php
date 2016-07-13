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
  <script>
	<?php
		$events = unserialize($_SESSION["Events"]);
		$index = $_GET["index"];
    $rate = $_GET["rate"];

		$eventObj = $events[$index];

    if($rate == "up"){
      $results = upVote($eventObj->time, $eventObj->loc_name);
      if($results){
        echo "document.location = 'viewIndividualEvent.php?index=$index';";
        $eventObj->up_votes += 1;
      }
      else{
        echo "Failed to vote. Try again maybe?";
        echo "setTimeout(function(){document.location='viewIndividualEvent.php?index=$index'},3000);";
      }
    }
    else if($rate == "down"){
      $results = downVote($eventObj->time, $eventObj->loc_name);
      if($results){
        echo "document.location = 'viewIndividualEvent.php?index=$index';";
        $eventObj->d_votes += 1;
      }
      else{
        echo "Failed to vote. Try again maybe?";
        echo "setTimeout(function(){document.location='viewIndividualEvent.php?$index'},3000);";
      }
    }
    else{
      echo "console.log('Why are you here?')";
    }

    $events[$index] = $eventObj;
    $_SESSION["Events"] = serialize($events);

?>
</script>
