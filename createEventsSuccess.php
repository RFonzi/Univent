<?php include 'functions.php';
  session_start();
?>

<!DOCTYPE html>
<html>
<?php


  //get current user logged in
	$user = unserialize($_SESSION["user"]);

  if(isset($_POST["createEvent"])){
    $time = $_POST["time"];
	$date = $_POST["date"];
	$e_name = $_POST["name"];
	$category = $_POST["category"];
	$e_desc = $_POST["description"];
	$contact_phone = $_POST["contactPhone"];
	$contact_email = $user->email;
	$type = $_POST["type"];
	$loc_name = $_POST["loc"];
	$latitude = $_POST["lat"];
	$longitude = $_POST["long"];

  $userpriv = getUserLevel($user->sid);

  if($userpriv == 2 && $category == "RSO"){
    $rid = getMyRSO($user);
    $results = createRSOEvent($time, $date, $e_name, $category, $e_desc,
				$contact_phone, $contact_email, $type, $loc_name, $latitude, $longitude, $user, $rid);

  }
  else{
    $results = createEvent($time, $date, $e_name, $category, $e_desc,
				$contact_phone, $contact_email, $type, $loc_name, $latitude, $longitude);
  }


  echo "<script type='text/javascript'>\n";
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
