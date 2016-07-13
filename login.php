<!DOCTYPE html>

<html>
<?php include 'functions.php';
  if(isset($_POST["signup"])){

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];



    $accttype = $_POST["accttype"];

    if($accttype == "superadmin"){
      $results = createSuperAdmin($username, $password, $email);

      if($results == false){
        echo nl2br("Failed to create superadmin account FOR SOME REASON\n");
      }
    }
    else if($accttype == "user"){
      $results = createUser($username, $password, $email);

      if($results == false){
        echo nl2br("Failed to create account. Username is taken.\n");
      }
    }
    else{
      echo nl2br("Successfully created account! Please log in...\n");
    }

  }
  else if(isset($_GET["login"]) && $_GET["login"] == "failed"){
    echo nl2br("Invalid credentials. Please try again.");
  }
?>

<head>
  <meta charset="utf-8">
  <title>university events</title>
  <link href="https://fonts.googleapis.com/css?family=Galada" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>

<body>

<div id="loginarea">

  <div id="loginbox">

    <h1>Log in as an existing user...</h1>
    <form name="login" action="loginsuccess.php" method="post">
      <input type="hidden" name="login" value=""/>
      <li><label>Username</label>
      <input name="username" type="username" pattern="[a-zA-Z0-9!@#$%^*_|.]{1,30}" placeholder="username">
      <li><label>Password</label>
      <input name="password" type="password" pattern="[a-zA-Z0-9!@#$%^*_|.]{1,20}" placeholder="password">
      <li>
      <input type="submit" value="Log in">
    </form>

  </div>

  <div id="signupbox">

    <h1>Sign up as a new user...</h1>
    <form name="signup" action="login.php" method="post">
      <input type="hidden" name="signup" value=""/>
      <li><label>Username</label>
      <input name="username" type="username" pattern="[a-zA-Z0-9!@#$%^*_|.]{1,30}" placeholder="username">
      <li><label>Email</label>
      <input name="email" type="email" pattern="[a-zA-Z0-9!@#$%^*_|.]{1,50}" placeholder="email@website.com">
      <li><label>Password</label>
      <input name="password" type="password" pattern="[a-zA-Z0-9!@#$%^*_|.]{1,20}" placeholder="password">
      <li style="font-size: 100%">
        <input name="accttype" type="radio" name="userprivilege" value="user" checked>User
<input name="accttype" type="radio" name="userprivilege" value="superadmin">Super Admin
<li>
      <input type="submit" value="Sign Up">
    </form>

  </div>

</div>


</body>

</html>
