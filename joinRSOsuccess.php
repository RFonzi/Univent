<?php include 'functions.php';
  session_start();
?>

<!DOCTYPE html>
<html>
<?php


  //get current user logged in
	$user = unserialize($_SESSION["user"]);
  $index = $_GET["index"];

  $rsoList = getRSO($user);
  $rso = $rsoList[$index];
  $results = joinRSO($rso->rid, $rso->name, $rso->university, $user);

  if(!$results){
    echo $results;
    echo "Failed to join RSO. Taking you back...";
    echo "<script>setTimeout(function(){document.location='joinRSO.php'},5000);</script>";
  }
  else{
    echo "<script>document.location='dashboard.php';</script>";
  }



  ?>
