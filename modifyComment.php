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
    $user = unserialize($_SESSION["user"]);
		$index = $_GET["index"];
    $action = $_GET["action"];

		$eventObj = $events[$index];

    if($action == "delete"){
      $results = deleteComment($user->sid, $eventObj->loc_name, $eventObj->time);
      if($results){
        echo "document.location = 'viewIndividualEvent.php?index=$index';";
      }
      else{
        echo "Failed to delete your comment. Try again maybe?";
        echo "setTimeout(function(){document.location='viewIndividualEvent.php?index=$index'},3000);";
      }
    }
    else if($action == "edit"){

      if(!isset($_GET["text"])){
        echo "Text is not set.";
      }
      else{
        $text = $_GET["text"];

        $results = updateComment($user->sid, $text, $eventObj->loc_name, $eventObj->time);
        if($results){
          echo "document.location = 'viewIndividualEvent.php?index=$index';";
        }
        else{
          echo "Failed to start editing comment. Try again maybe?";
          echo "setTimeout(function(){document.location='viewIndividualEvent.php?$index'},3000);";
        }
      }
    }
    else{
      echo "console.log('Why are you here?')";
    }

?>
</script>
