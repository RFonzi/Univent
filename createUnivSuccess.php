<?php include 'functions.php';
  session_start();
?>
<!DOCTYPE html>
<html>
<?php
  echo "<script type='text/javascript'>\n";
  
  //get current user logged in
	$user = unserialize($_SESSION["user"]);
  
  if(isset($_POST["createUniv"])){
	$name = $_POST["univName"];
	$location = $_POST["location"];
	$description = $_POST["description"];
	
	$results = createUniversity($name, $location, $description, $user);

    if(!$results){
      echo "takemeback();\n";
    }
    else{
      //Old Way with POST
      /*echo "<form action='dashboard.php' method='post' name='redirectlogin'>";
      echo "<input type='hidden' name='user' value='" . $results . "'>";
      echo "</form>";*/

      echo "document.location = 'dashboard.php';\n";
    }
  }
 ?>


</script>
</html>