<?php include 'functions.php';
  session_start();
?>

<!DOCTYPE html>
<html>
<?php
  echo "<script type='text/javascript'>\n";
  if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $results = getUser($username, $password);

    if(!$results){
      echo "takemeback();\n";
    }
    else{
      //Old Way with POST
      /*echo "<form action='dashboard.php' method='post' name='redirectlogin'>";
      echo "<input type='hidden' name='user' value='" . $results . "'>";
      echo "</form>";*/
      $_SESSION["user"] = serialize($results);

      echo "document.location = 'dashboard.php';\n";
    }
  }
 ?>


</script>
</html>
