<?php
	
	require('db_connect.php');


	if (isset($_SESSION["welcome"]) || isset($_SESSION["info"])){
		$type = $_SESSION["welcome"];
		$info = $_SESSION["info"];
	}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
		* {
    		margin:0;
    		padding:0;
    	}
    	body{
    		background-image: url('welcome-bg.jpeg');
    		background-repeat: no-repeat;

    	}
    	.header{
    		height:100px;
      		top:0;
    		padding:50px 50px 50px 50px;
    		left: 25%;
    		font-family:Verdana;
    		font-weight: 400;
    		font-size:30px;
    	}
    	.info{
			width:50%;
			height:60%;
			background:rgb(59,89,152,0.7);
			margin-left:25%;
			border:solid black 1px;
			box-shadow:5px 5px 10px black;
			padding-bottom: 10px;
			margin-top:50px;
		}
		.content{
			width:100%; 
			height:20%; 
			color:#3b5998; 
			font-family:Roboto
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
	

	</style>
</head>
<body>
	<?php
	if (isset($_SESSION["welcome"]) && isset($_SESSION["info"])){
		$_SESSION["knowme"] = "welcome.php";
		if ($type == "Student"){ 
			$sql = "select * from s_registration where email='".$info."'";
			$result =mysqli_query ($connectivity,$sql);
			while($row = mysqli_fetch_assoc($result))
			{ ?>
				<header class="header">
					<h1 style = "color:white; text-decoration:overline underline;">
						Welcome<a href="logout.php"><button style="margin-left:67%; top:-50px; position: relative; background:red; border:1px solid red;" class="button">LogOut</button></a>
					</h1>
					<p style="color:white;"><?=$row["name"];?>
					</p>
				</header>

				<div class="info">
					<div style="width:100%; height:30%; background:url('details.jpg') 100px 110px; ">
						<div style="background:#f7f7f7; height:130%; width:20%; margin-left:5%; margin-top:5%; padding:1% 1% 1% 1%;">
							<img style="width:100%; height:100%;" src="<?='Image/'.$row["image"];?>" alt="you">
						</div>
					</div>
					<div style="background:#dfe3ee; height:35%; width:90%; box-shadow:1px 1px 5px black; margin-top:2%; margin-left:5%;border-radius:2px; padding-bottom: 20px;">
							<div class="content" style="background:#f7f7f7;"><h3><center>Your Information</center></h3></div><br>
							<div class="content" style="padding-left:20px;"><h3>Name: <?=$row["name"];?></h3></div>
							<div class="content" style="padding-left:20px;"><h3>Email:<?=$row["email"];?></h3></div>
							<div class="content" style="padding-left:20px;"><h3>Course:<?=$row["course"];?></h3></div>
							<div class="content" style="padding-left:20px;"><h3>Address:<?=$row["address"];?></h3></div><br>
							<a href="update_users.php"><button style="margin-left:25%;" class="button">Update Password</button></a>
							<a href="delete.php"><button class="button">Delete Account</button></a>
					</div>
				</div> 
		<?php
			}	
		}else {
			$sql = "select * from t_registration where email='".$info."'";
			$result =mysqli_query ($connectivity,$sql);
			while($row = mysqli_fetch_assoc($result))
			{ ?>

			<header class="header">
						<h1 style = "color:white; text-decoration:overline underline;">
							Welcome<a href="logout.php"><button style="margin-left:67%; top:-50px; position: relative; background:red; border:1px solid red;" class="button">LogOut</button></a>
						</h1>
						<p style="color:white;"><?=$row["name"];?>				
			</header>

					<div class="info">
						<div style="width:100%; height:30%; background:url('details.jpg') 100px 110px; ">
							<div style="background:#f7f7f7; height:130%; width:20%; margin-left:5%; margin-top:5%; padding:1% 1% 1% 1%;">
								<img style="width:100%; height:100%;" src="<?='Image/'.$row["image"];?>" alt="you">
							</div>
						</div>
						<div style="background:#dfe3ee; height:35%; width:90%; box-shadow:1px 1px 5px black; margin-top:2%; margin-left:5%;border-radius:2px; padding-bottom: 20px;">
								<div class="content" style="background:#f7f7f7;"><h3><center>Your Information</center></h3></div><br><br>
								<div class="content" style="padding-left:20px;"><h3>Name: <?=$row["name"];?></h3></div>
								<div class="content" style="padding-left:20px;"><h3>Email:<?=$row["email"];?></h3></div>
								<div class="content" style="padding-left:20px;"><h3>Address:<?=$row["address"];?></h3></div>
								<div class="content" style="padding-left:20px;"><h3>Department:<?=$row["department"];?></h3></div>
								<div class="content" style="padding-left:20px;"><h3>Salary:<?=$row["salary"];?></h3></div><br>
								<a href="update_users.php"><button style="margin-left:25%;" class="button">Update Password</button></a>
								<a href="delete.php"><button class="button">Delete Account</button></a>
						</div>
					</div> 
		<?php
			}	
		}
	}else{
		header ('Location:Login.php');
		exit();
	}
?>
</body>
</html>