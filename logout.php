<?php
	session_start();
	session_unset();
	session_destroy();
	mysqli_close($connectivity);
	header('Location:Login.php');
	exit();
?>