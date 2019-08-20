<?php
	require ('db_connect.php');

//----------------------Checking email format------

	$email = $_POST['name'];
    // Validate e-mail
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $_SESSION["login"] = "";
    }else {
    	$_SESSION["login"] = "Use correct email format.";
    	header('Location:Login.php?email=invalid');
    }

//-----------------Checking Admin-----------------


	if ($_POST['type'] == "Admin"){
		$sql = "select * from login";
		$result = mysqli_query($connectivity,$sql);
		$success = 0;
		while ($row = mysqli_fetch_assoc($result)){
			$id_admin = $row['id'];
			if (($_POST['name'] == $row['name']) && ($_POST['password'] == $row['password'])){
				$success += 1;
			}

			else {
				$success += 0;
			}
		}

		if ($success >= 1){
			echo "success";
			$_SESSION["infos"] = $_POST ["name"];
			header('Location:admin.php?id='.$id_admin.''); 
		}
		else{
			header('Location:Login.php?user=not authorized');
			$_SESSION["error"] = "Make sure you have entered your email and password correctly";
			exit();
		}
	}		

//-----------------------Checking Students and Teachers-----------

	else if ($_POST['type'] == "Student"){
		$query = "select * from s_registration";
		$value = mysqli_query($connectivity,$query);
		$dev = 0;
		while ($row = mysqli_fetch_assoc($value)){
			$id_student = $row ['id'];
			if (($_POST['name'] == $row['email']) && ($_POST['password'] == $row['password'])){
				$dev += 1;
				$_SESSION["pass"] = "Incorrect password";
			}

			else {
				$dev += 0;
			}
		}

		if ($dev >= 1){
			echo "success";
			$_SESSION["info"] = $_POST ["name"];
			header('Location:welcome.php?id='.$id_student.'');
			
		}
		else{
			header('Location:Login.php?user=wrong student');
			$_SESSION["error"] = "Make sure you have entered your email and password correctly";
			exit();
		}


	}
	else{
		$query = "select * from t_registration";
		$value = mysqli_query($connectivity,$query);
		$dev = 0;
		while ($row = mysqli_fetch_assoc($value)){
			$id_teacher = $row['id'];
			if (($_POST['name'] == $row['email']) && ($_POST['password'] == $row['password'])){
				$dev += 1;
			}

			else {
				$dev += 0;
			}
		}

		if ($dev >= 1){
			$_SESSION["info"] = $_POST ["name"];
			header('Location:welcome.php?id='.$id_teacher.'');
			
		}
		else{
			header('Location:Login.php?user=wrong teacher');
			$_SESSION["error"] = "Make sure you have entered your email and password correctly";
			exit();
		}	
	}	


	//--------welcome page infos------------
	 $_SESSION["welcome"] = $_POST ["type"];

	
?>