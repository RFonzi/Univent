<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>university events</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
<?php include 'functions.php';

  echo createUser("testuser", "testpassword", "test@10minutemail.com");
  $user = getUser("testuser", "testpassword");

  echo nl2br($user->sid . "\n" . $user->username . "\n" . $user->password . "\n" . $user->email);

?>

    <form name="login" action="" method="post">
      <li><label>Username</label>
      <input name="username" type="username" placeholder="username">
      <li><label>Password</label>
      <input name="password" type="password" placeholder="password">
      <input type="submit" value="Log in">
    </form>


    <form name="signup" action="" method="post">
      <li><label>Username</label>
      <input type="username" placeholder="username">
      <li><label>Email</label>
      <input type="email" placeholder="email@website.com">
      <li><label>Password</label>
      <input type="password" placeholder="password">
      <input type="submit" value="Sign Up">
    </form>

</body>

</html>
