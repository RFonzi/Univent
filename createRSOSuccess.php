<?php include 'functions.php';
  if(isset($_POST["createRSO"])){
	$rname = $_POST["rsoName"];
	$uni_name = $_POST["university"];
	$rso_desc = $_POST["description"];
	//$user = $_POST["user"];
	
	$result = createRSO($rname, $uni_name, $rso_desc, $user);
	
	echo "<form action='dashboard.php' method='post' name='redirectEventToDash'>";
	
	echo "</form>";
	}
?>
<!DOCTYPE html>
<html>
<script type="text/javascript">
function takemeback() {
  document.location = "createrso.php?createRSO=failed";
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