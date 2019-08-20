<?php
	require('db_connect.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete Account</title>
	<style>
		.button {
			color: white;
			background :green;
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
	</style>
</head>
<?php
	if (isset ($_SESSION["infos"])){ ?>
		<body>
			<form action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
			<p>Input ID: <input type="text" name="id" class="field"></p>
			<input type="submit" value="Submit" class="button">
			</form>
		</body>
		</html>

		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST"){
				if ($_POST['id'] == ""){
					echo "Input the desired id no.";
				}
				else{
					$sql = "delete from s_registration where id='".$_POST['id']."'";
					if (mysqli_query($connectivity,$sql)){
						echo "Accout has been successfully deleted";
						header ('Location:student_data.php');
					}
					else {
						echo "Not successful";
					}
				}
			}
	 }
	else {
		header ('Location:Login.php');
		exit();
	}		
?>