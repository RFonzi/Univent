<?php include 'functions.php';
  session_start();
?>
<!DOCTYPE html>
<html>
<?php
  echo "<script type='text/javascript'>\n";
  
  //get current user logged in
	$user = unserialize($_SESSION["user"]);
  
  if(isset($_POST["createRSO"])){
    $rname = $_POST["rsoName"];
	$uni_name = $_POST["university"];
	$rso_desc = $_POST["description"];
	
	$results = createRSO($rname, $uni_name, $rso_desc, $user);

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