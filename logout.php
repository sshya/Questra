<?php include("./includes/session.php"); ?>
<?php include("./includes/functions.php"); ?>



<?php
	//Destory the session and reset the cookie
	session_start();
	$_SESSION = array();
	if (isset($_COOKIE[session_name()])) {
	  setcookie(session_name(), '', time()-42000, '/');
	}
	session_destroy(); 
	redirect_to("index.php");
?>
