<?php
    session_start();
    $_SESSION["type"] = "student";
?>


<DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

        <?php if ($_SESSION["account"] != "") { ?>
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

        .main{
            height: 620px;
            width: 50%;
            justify-content: center;
            position: absolute;
            top:12%;
            left:25%;
            box-shadow: 4px 4px 5px black;
           
        }
        .image {
            float:left;
            width:40%;
            height:100%;
            position:relative;
        }
        .registration {
            float:right;
            width: 60%;
            height:100%;
            background:rgba(0,0,0,0.7);
        }
        .banner{
            color:white;
            font-size: 32px;
            margin: 0;
            text-align:center;
            position:absolute;
            top:40%;
            left:25%;
        }
        .shade{
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            position:absolute;
            top:0;
            left:0;
        }
        .custom {
            outline: none;
            padding: 1em;
            background:none;
            border: 1px solid #ffffff;
            color:#ffffff;
            font-size: .9em;
            margin:0 0 1.8em 0;
            width: 93%;
        }
        .button {
			color: white;
			background: #F44336;
			border :solid #F44336 1px;
            text-align: center;
            font-size:.9em;
            text-decoration:none;
            padding:1em, 2em;
            cursor:pointer;
            text-transform:uppercase;
            font-weight:600;
            height:40px;
            width:80px;
			
		}
		.button:hover {
			background:rgba(0,0,0,0.5);
            border:1px solid white;
            transition: 1s;
		}
        img {
            object-fit: cover;
            object-position: 65% 0;
                 
        }
    </style>
</head>
<body background="image1.jpg">
    <header class="at-top">
        <?php if (isset($_SESSION["account"])) { ?>
                <span class="at-top"><?=$_SESSION["account"]?></span>
        <?php } 
            $_SESSION["account"] = "";?><br>
    </header>
    <div class="main">
        <div class="image">
            <img style = "height:100%; width:100%;" src="image1.jpg" alt="background">  
            <div class="shade"></div>
            <p class="banner">Students</p> 
        </div>
        <div class="registration">
            <form style="padding:40px 40px 40px 40px;" action="insert_db.php" method="POST" enctype="multipart/form-data">
                    <p style="color:white; font-size:1em; text-transform:uppercase; font-weight:700; letter-spacing:2px;">Register Now</p>
                    <input class="custom" type="text" name="name" placeholder="Name" required>
                    <?php if (isset($_SESSION["email_error"])) { ?>
                        <span style="color:red;"><?=$_SESSION["email_error"]?></span>
                    <?php } 
                        $_SESSION["email_error"] = "";?>
                    <input class="custom" type="text" name="email" placeholder="Email" required>
                    <input class="custom" type="password" name="password" placeholder="Password" required>
                    <select class="custom" name="course">
                        <option style="color:grey;">PHP
                        <option style="color:grey;">Introduction to Linux Server
                        <option style="color:grey;">Web Designing
                    </select>
                    <input style="margin-top: 1em;" class="custom" type="text" name="address" placeholder="Address" required>
                    <?php if (isset($_SESSION["extension"])) { ?>
                                <span style="color:red;"><?=$_SESSION["extension"]?></span>
                    <?php } 
                        $_SESSION["extension"] = "";?>
                    <input name="image" type="file" onchange="readURL(this);" accept="image/" required /><br><br><br>
                    <input name="submit" class="button" type="submit" value ="submit">
            </form>
        </div>
    </div>
</body>
</html>