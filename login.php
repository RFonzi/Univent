<?php include 'functions.php';
  if(isset($_POST["signup"])){

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $results = createUser($username, $password, $email);

    if($results){
      $accttype = $_POST["accttype"];
      if($accttype == "superadmin"){
        $results = createSuperAdmin($username, $password, $email);

        if($results == false){
          echo nl2br("Failed to create superadmin account FOR SOME REASON\n");
        }
      }
      else{
        echo nl2br("Successfully created account! Please log in...\n");
      }
    }
    else{
      echo nl2br("Failed to create account. Username is taken.\n");
    }

  }
  else if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    if($username == "" || $password == ""){
      echo nl2br("Please fill out all login fields.\n");
    }
    else{
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
  }
?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <title>university events</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>

    <h1>Log in as an existing user...</h1>
    <form name="login" action="loginsuccess.php" method="post">
      <input type="hidden" name="login" value=""/>
      <li><label>Username</label>
      <input name="username" type="username" placeholder="username">
      <li><label>Password</label>
      <input name="password" type="password" placeholder="password">
      <li>
      <input type="submit" value="Log in">
    </form>

    <hr>

    <h1>Sign up as a new user...</h1>
    <form name="signup" action="login.php" method="post">
      <input type="hidden" name="signup" value=""/>
      <li><label>Username</label>
      <input name="username" type="username" placeholder="username">
      <li><label>Email</label>
      <input name="email" type="email" placeholder="email@website.com">
      <li><label>Password</label>
      <input name="password" type="password" placeholder="password">
      <li>
        <input name="accttype" type="radio" name="userprivilege" value="user" checked> User
        <input name="accttype" type="radio" name="userprivilege" value="superadmin"> Super Admin
      <li>
      <input type="submit" value="Sign Up">
    </form>



</body>

</html>
