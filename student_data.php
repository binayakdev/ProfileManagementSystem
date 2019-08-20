<?php
	require ('db_connect.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Data</title>
	<style>
		*{
			margin:0;
		}
		body{
			background:url('s_bg.jpeg');
		}
		.heading{
			height:70px;
			width:100%;
			background:maroon;
			color:white;
			font-family:sans-serif;
			font-weight: 200;
			text-align: center;
			padding: 25px 10px 10px 10px;
			margin-bottom: 50px;
		}
		.database {
			text-align: center;
		}
		.database table{
			margin: 0 auto;
		}
		.table, th, td{
			border:1px solid white;
			border-collapse: collapse;
			opacity: 0.93;
		}
		th, td{
			padding:30px;
			text-align:center;
		}
		tr:nth-child(even){
			background-color: #e8e8e8;
		}
		tr:nth-child(odd){
			background-color: white;
		}
		.button {
			-moz-box-shadow:inset 0px 1px 0px 0px #bbdaf7;
			-webkit-box-shadow:inset 0px 1px 0px 0px #bbdaf7;
			box-shadow:inset 0px 1px 0px 0px #bbdaf7;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #378de5));
			background:-moz-linear-gradient(top, #79bbff 5%, #378de5 100%);
			background:-webkit-linear-gradient(top, #79bbff 5%, #378de5 100%);
			background:-o-linear-gradient(top, #79bbff 5%, #378de5 100%);
			background:-ms-linear-gradient(top, #79bbff 5%, #378de5 100%);
			background:linear-gradient(to bottom, #79bbff 5%, #378de5 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#378de5',GradientType=0);
			background-color:red;
			-moz-border-radius:6px;
			-webkit-border-radius:6px;
			border-radius:6px;
			border:1px solid #84bbf3;
			display:inline-block;
			cursor:pointer;
			color:#ffffff;
			font-family:Arial;
			font-size:15px;
			font-weight:bold;
			padding:6px 24px;
			text-decoration:none;
			text-shadow:0px 1px 0px #528ecc;
		}
		.button:hover {
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #378de5), color-stop(1, #79bbff));
			background:-moz-linear-gradient(top, #378de5 5%, #79bbff 100%);
			background:-webkit-linear-gradient(top, #378de5 5%, #79bbff 100%);
			background:-o-linear-gradient(top, #378de5 5%, #79bbff 100%);
			background:-ms-linear-gradient(top, #378de5 5%, #79bbff 100%);
			background:linear-gradient(to bottom, #378de5 5%, #79bbff 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#378de5', endColorstr='#79bbff',GradientType=0);
			background-color:#378de5;
		}
		.button:active {
			position:relative;
			top:1px;
		}
		.back {
			background :lightgreen;
			border: 1px solid lightgreen;
			position:relative;
			margin-left: 90%;
		}
	</style>
	</style>
</head>
<?php if (isset ($_SESSION["infos"])){ ?>
		<body>
			<?php
				$query = "select * from s_registration";
				$result = mysqli_query($connectivity,$query);
		 			?>
					<header class="heading">
						<h1>Student Database</h1>
						<a href="admin.php"><button class="button back">Go Back</button></a>
					</header>
					<div class="database">
							<a href="Registration_student.php"><button class="button">Add User</button></a>
							<a href="s_delete.php"><button class="button">Delete Account</button></a>
							<a href="s_update.php"><button class="button">Update Account</button></a>	
							<table align="center" class="table">
								<tr style="background-color:lightblue;">
									<th>Name</th>
									<th>Email</th>
									<th>Password</th>
									<th>Course</th>
									<th>Address</th>
									<th>Image</th>
									<th>ID</th>
								</tr>
								<?php
								if (mysqli_num_rows($result) == 0){ ?>
									<tr>
										<th colspan="7">No Data</th>
									</tr>
								<?php }
						 			?>
						<?php
						while ($row = mysqli_fetch_assoc($result)){
							?>

							<tr>
								<th><?=$row["name"];?></th>
								<th><?=$row["email"];?></th>
								<th><?=$row["password"];?></th>
								<th><?=$row["course"];?></th>
								<th><?=$row["address"];?></th>
								<th><image style="height:100px; width:100px;"src="<?='Image/'.$row["image"];?>" alt="image"></th>
								<th><?=$row["id"];?></th>
							</tr>
						<?php
						}
						?>
						</table>
						
				</div>
	<?php } else {
		header ('Location:Login.php');
		exit();
	}
	?>
</body>
</html>