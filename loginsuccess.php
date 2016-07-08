<?php include 'functions.php';

  if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $results = getUser($username, $password);

    if(!$results){
      echo nl2br("Incorrect login details.\n");
    }
    else{
      $url = '/dashboard.php';

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $results);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

      $response = curl_exec($ch);

      header('Location: ' . $response);
    }

  }
?>
