<?php
require ('db_connect.php');
	if (isset($_SESSION["welcome"]) && isset($_SESSION["info"])){
		if ($_SESSION["welcome"] == "Student"){
			$sql = "delete from s_registration where email='".$_SESSION['info']."'";
			if (mysqli_query($connectivity,$sql)){
				Session_unset();
				$_SESSION["delete"] = "Account has been deleted";
				header('Location:Login.php');
				exit();
			}
			else{
				echo "Not successful";
			}
		}else if($_SESSION["welcome"] == "Teacher") {
			$sql = "delete from t_registration where email='".$_SESSION['info']."'";
			if (mysqli_query($connectivity,$sql)){
				Session_unset();
				$_SESSION["delete"] = "Account has been deleted";
				header('Location:Login.php');
				exit();
			}
			else{
				echo "Not successful";
			}
		}
	}else {
		header ('Location:Login.php');
		exit();
	}

?>