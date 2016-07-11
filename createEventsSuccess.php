
<?php include 'functions.php';
  if(isset($_POST["createEvent"])){

    //$username = $_POST["username"];
    //$email = $_POST["email"];
    //$password = $_POST["password"];
	
	$time = $_POST["time"];
	$date = $_POST["date"];
	$e_name = $_POST["name"];
	$category = $_POST["category"];
	$e_desc = $_POST["description"];
	$contact_phone = $_POST["contactPhone"];
	//$contact_email = $_POST["email"];
	$type = $_POST["type"];
	$loc_name = $_POST["loc"];
	$latitude = $_POST["lat"];
	$longitude = $_POST["long"];
	
	$super_approval = 1;
	$admin_approval = 1;
	
    //$results = createEvent($username, $password, $email);
	echo "<form action='dashboard.php' method='post' name='redirectEventToDash'>";
	
	echo "</form>";
	}
?>
<!DOCTYPE html>
<html>

<head>
</head>
<body>
	<h1>Create Events</h1>
	
</body>
</html>