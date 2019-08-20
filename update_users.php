<?php
	require ('db_connect.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Password</title>
	<style>
		.button {
			text-align: center;
			color: white;
			background :black;
			border :solid white 1px;
			height : 35px;
			width:280px;
			margin-left:3%;
		}
		.button:hover {
			background :lightgreen;
		}

		.field{
			outline: none;
            padding: 1em;
            background:none;
            border: 1px solid black;
            color:black;
            font-size: .9em;
            margin:0 0 1.8em 0;
            width: 20%;
		}
	</style>
</head>
	<?php if (isset($_SESSION["welcome"]) && isset($_SESSION["info"])){ ?>
			<body>
				<form action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
					<p>Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="field" type="text" name="pass"></p>
					<p>Confirm Password:&nbsp;&nbsp;&nbsp;<input class="field" type="text" name="pass_again"></p>
					<input type="submit" value="Submit" class="button"><br><br>
					<a href="welcome.php">Go Back</a>
				</form>
			</body>
			</html>

			<?php
				if ($_SERVER["REQUEST_METHOD"] == "POST"){
					if ($_SESSION["welcome"] == "Student"){
						if (($_POST["pass"] == $_POST["pass_again"]) && (  (!empty ($_POST["pass"])) || (!empty ($_POST["pass_again"])))){
							$sql = "update s_registration set password='".$_POST["pass"]."' where email='".$_SESSION['info']."'";
							if (mysqli_query($connectivity,$sql)){
								echo "Success";
								exit();
							}
							else {
								echo "Password not changed";
							}
						}else{
							echo "Make sure both the password matches or are not empty.";
						}
					}
					else {
						if ($_POST["pass"] == $_POST["pass_again"]){
							$sql = "update t_registration set password='".$_POST['pass']."' where email='".$_SESSION['info']."'";
							if (mysqli_query($connectivity,$sql)){
								echo "Success";
								exit();
							}
							else {
								echo "Password not changed";
							}
						}else{
							echo "Make sure both the password matches";
						}
					}
				}

	}else {
		header ('Location:Login.php');
	}
			?>