<?php include 'functions.php';
  session_start();
?>
<!DOCTYPE html>
<html>
<?php
  echo "<script type='text/javascript'>\n";

  //get current user logged in
	$user = unserialize($_SESSION["user"]);
	$event = unserialize($_SESSION["IndivEvent"]);

  if(isset($_POST["leaveComment"])){
	$text = $_POST["comment"];
	$index = $_POST["leaveComment"];

	$results = createComment($user->sid, $event->time, $event->loc_name, $text);
  //echo($results);

    if(!$results){
      echo "takemeback();\n";
    }
    else{
      //Old Way with POST
      /*echo "<form action='dashboard.php' method='post' name='redirectlogin'>";
      echo "<input type='hidden' name='user' value='" . $results . "'>";
      echo "</form>";*/

      echo "document.location = 'viewIndividualEvent.php?index=$index';\n";
    }
  }
 ?>


</script>
</html>
