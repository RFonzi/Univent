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
	
	$a = $event->time;
	settype($a, "string");
	echo gettype($event->time);
	
	$results = createComment($user->sid, $a, $event->e_name, $text);

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