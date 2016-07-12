<?php include "functions.php";
session_start();
 ?>

 <!DOCTYPE html>
<html>
<body>
Logging out...

<?php
// remove all session variables
session_unset();

// destroy the session
session_destroy();
?>
<script>
document.location = "login.php";
</script>

</body>
</html>
