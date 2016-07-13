<?php include 'functions.php';
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
	 <link href="https://fonts.googleapis.com/css?family=Fontdiner+Swanky" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
	<?php
		$events = unserialize($_SESSION["Events"]);
		$user = unserialize($_SESSION["user"]);

		$index = $_GET["index"];

		$eventObj = $events[$index];

    $comments = array();
		$comments = getComments($eventObj->time, $eventObj->loc_name);
		$_SESSION["IndivEvent"] = serialize($eventObj);
	?>
	<h1><?php echo $eventObj->e_name; ?></h1>


<iframe
 width="450"
 height="250"
 frameborder="0" style="border:0"
 src="https://www.google.com/maps/embed/v1/search?key=AIzaSyAV7hEjYqgMNQ4Xn2hQnCBluRK-8A_ejro
 &q= <?php echo $eventObj->latitude.",". $eventObj->longitude; ?>
 &zoom=18">
</iframe>

<div id='rateEvent'>
<label id="ratelabel">Rate this event:</label>
<input type="button" id="upButton" value="+ <?php echo $eventObj->up_votes; ?>" onclick="document.location='rate.php?index=<?php echo $index; ?>&rate=up';">
<input type="button" id="downButton" value="- <?php echo $eventObj->d_votes; ?>" onclick="document.location='rate.php?index=<?php echo $index; ?>&rate=down';">
</div>

<form name="leaveComment" action="leaveCommentSuccess.php" method="post">
<input type="hidden" name="leaveComment" value="<?php echo $index; ?>"/>

<li><label>Comments</label>
<textarea type="text" id="comment" name="comment" rows="8" cols="50"></textarea>
<input type="submit" value="Comment!"/>
</form>

<?php
function cmp($a, $b)
{
    return strcmp($a->timestamps, $b->timestamps);
}

usort($comments, "cmp");

echo "<div id='userCommentArea'>";
for($i=count($comments) - 1; $i >= 0; $i--)
{
  echo "<div id='commentdiv'>";
  echo "<label id='commentName'>".getUserName($comments[$i]->sid)."</label>";
  echo "<label id='commentTime'>".$comments[$i]->timestamps."</label>";
  echo "<label id='commentText'>".$comments[$i]->text."</label>";
  if($comments[$i]->sid == $user->sid){
    echo "<input type=\"button\" id=\"editComment\" value=\"Edit\" onclick=\"document.getElementById('edit').style.display='block';document.getElementById('submitEdit').style.display='block';\">";
    echo "<input type=\"button\" id=\"deleteComment\" value=\"Remove\" onclick=\"document.location='modifyComment.php?index=$index&action=delete';\">";
    echo "<textarea type='text' id='edit' rows='2' cols='10'>".$comments[$i]->text."</textarea>";
    echo "<input type=\"button\" id=\"submitEdit\" value=\"Submit\" onclick=\"var text = $('textarea#edit').val(); document.location='modifyComment.php?index=$index&action=edit&text=' + text;\">";
  }
  echo "</div>";

}
echo "</div>";
?>




	<form action="dashboard.php">
		<input type="hidden" name="returnFromTable" value=""/>
		<input type="submit" value="RETURN TO DASH" />
	</form>
</body>
</html>
