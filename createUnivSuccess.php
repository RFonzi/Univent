<?php include 'functions.php';
  if(isset($_POST["createUniv"])){
	$name = $_POST["univName"];
	$location = $_POST["location"];
	$description = $_POST["description"];
	//$user = $_POST["user"];
	
	result = createUniversity($name, $location, $description, $user);
	
	echo "<form action='dashboard.php' method='post' name='redirectEventToDash'>";
	
	echo "</form>";
	}
?>
<!DOCTYPE html>
<html>
<script type="text/javascript">
function takemeback() {
  document.location = "createUniv.php?createUniv=failed";
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