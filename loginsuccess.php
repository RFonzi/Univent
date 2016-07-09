<?php include 'functions.php';

  if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $results = getUser($username, $password);

    if(!$results){
    }
    else{
      echo "<form action='dashboard.php' method='post' name='redirectlogin'>";
      /*foreach($_POST as $a => $b){
        echo "<input type='hidden' name='" . htmlentities($a) . "' value='" . htmlentities($b) . "'>";

      }*/
      echo "<input type='hidden' name='user' value='" . $results . "'>";
      echo "</form>";
    }
  }

?>

<!DOCTYPE html>
<html>
<script type="text/javascript">
function takemeback() {
  document.location = "login.php?login=failed";
}

if(typeof redirectlogin != "undefined"){
  document.redirectlogin.submit();
}
else{
  takemeback();
}
</script>
</html>
