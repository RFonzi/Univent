<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>university events</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>

  

<?php include 'functions.php';

  /*echo createUser("testuser", "testpassword", "test@10minutemail.com");
  $user = getUser("testuser", "testpassword");

  echo nl2br($user->sid . "\n" . $user->username . "\n" . $user->password . "\n" . $user->email);
  */
?>

    <h1>Log in as an existing user...</h1>
    <form name="login" action="" method="post">
      <li><label>Username</label>
      <input name="username" type="username" placeholder="username">
      <li><label>Password</label>
      <input name="password" type="password" placeholder="password">
      <li>
      <input type="submit" value="Log in">
    </form>

    <hr>

    <h1>Sign up as a new user...</h1>
    <form name="signup" action="" method="post">
      <li><label>Username</label>
      <input type="username" placeholder="username">
      <li><label>Email</label>
      <input type="email" placeholder="email@website.com">
      <li><label>Password</label>
      <input type="password" placeholder="password">
      <li>
        <input type="radio" name="userprivilege" value="user" checked> User
        <input type="radio" name="userprivilege" value="superadmin"> Super Admin
      <li>
      <input type="submit" value="Sign Up">
    </form>

</body>

</html>
