<?php
	Session_start();

	if (isset($_SESSION["knowme"])){
		if ($_SESSION["knowme"] == "admin.php"){
			header ('Location:admin.php');
			exit ();
		}else {
			header ('Location:welcome.php');
			exit();
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

    	<?php if (($_SESSION["error"] != "")) { ?>
    	    .at-top{
	    	list-style-type: disc;
		    margin: 0 10px 15px 10px;
		    padding: 8px 35px 8px 30px;
		    color: #B94A48;
		    background-color: #F2DEDE;
		    border: 2px solid #EED3D7;
		    border-radius: 4px;
		    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
		}

		<?php } ?>

        .box {
			border :solid grey 1px;
			height :30px;
			width :320px;
		}
		.box:hover{
			border :solid lightblue 1px;
		}
		.box:active{
			background:lightyellow;
		}

		.button {
			color: white;
			background :black;
			border :solid white 1px;
			height : 35px;
			width:280px;
			margin-left:3%;
		}
		.button:hover {
			background :grey;
		}
		.marquee{
			background:black;
			color:white;
		}
    </style>
</head>
<body>
	<header class="at-top">
		<?php if (isset($_SESSION["error"])) { ?>
                <span class="at-top"><?=$_SESSION["error"]?></span>
         <?php } 
               $_SESSION["error"] = "";?>
        <?php if (isset($_SESSION["delete"])) { ?>
        		<style>
        			 .at-top{
	    	list-style-type: disc;
		    margin: 0 10px 15px 10px;
		    padding: 8px 35px 8px 30px;
		    color: #B94A48;
		    background-color: #F2DEDE;
		    border: 2px solid #EED3D7;
		    border-radius: 4px;
		    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
		}
        		</style>
                <span class="at-top"><?=$_SESSION["delete"]?></span>
         <?php } 
               unset($_SESSION["delete"])?>
	</header>
    <div style="padding : 10px 10px 10px 20%; margin-left: 18%; margin-right: 20%; margin-top:10%; border: solid black 2px;">
		<h1 style = "font-family: Verdana; text-shadow: 2px 2px 4px #000000; margin-left:15%;"><centre>Sign in</centre></h1>
		<form action="validation.php" method="POST">
			<?php if (isset($_SESSION["login"])) { ?>
                <span style="color:red;"><?=$_SESSION["login"]?></span>
            <?php } 
                $_SESSION["login"] = "";?><br>
			<input class="box" type="text" name="name" placeholder="  Email" required></p>
			<input class="box" type="password" name="password" placeholder="  Your Password" required></p>
			<select class ="box" name="type">
				<option>Admin</option>
				<option>Teacher</option>
				<option>Student</option>
			</select>
			</p>
			<br>
			<input class = "button" type="submit" value ="submit">
        </form>
        <br><br><p style = "font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; margin-left: -250px;">New? Register now: </p>
        <a style = "margin-left: -250px;" href="Registration_student.php">Student</a>
        <a href="Registration_teacher.php">Teacher</a>
	</div><br><br><br><br>
	<marquee class="marquee">Admin can update and delete users and also view registered data. Note: Use your valid email in the username.</marquee>
</body>
</html>