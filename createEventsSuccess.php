
<?php include 'functions.php';
  if(isset($_POST["createEvent"])){

    
	
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
	
    $result = createEvent($time, $date, $e_name, $category, $e_desc, 
				$contact_phone, $contact_email, $type, $loc_name, $latitude, $longitude);
	echo "<form action='dashboard.php' method='post' name='redirectEventToDash'>";
	
	echo "</form>";
	}
?>
<!DOCTYPE html>
<html>
<script type="text/javascript">
function takemeback() {
  document.location = "createEvents.php?createEvent=failed";
}

if(typeof redirectEventToDash != "undefined"){
  document.redirectEventToDash.submit();
}
else{
  takemeback();
}
</script>
<head>
</head>
<body>
</body>
</html>