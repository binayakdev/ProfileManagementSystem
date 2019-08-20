<?php
	require ('db_connect.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Account</title>
		<style>
		*{
			margin:0;
		}
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
        .marquee{
			background:black;
			color:white;
		}
		</style>
</head>
<body>
	<?php
			if (isset ($_SESSION["infos"])){ ?>
						<marquee class="marquee">Input the id no of the account you wish to update. And only fill in the fields you want to change.</marquee>

					<div style="margin-left: 2%; margin-top: 2%;">
						<form action="<?=$_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
						<p>Input ID: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="id" class ="field" required></p>
						<p>Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="name" class ="field"></p>
						<p>Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="email" class ="field"></p>
						<p>Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="password" class ="field"></p>
						<p>Address:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="address" class ="field"></p>
						<p>Department:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select class="field" name="course">
							<option></option>
							<option>Computing</option>
							<option>Networking</option>
							<option>Multi-Media</option>
						</select></p>
						<p>Salary:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="salary" class ="field"></p>
						<input type="file" name="image" onchange="readURL(this);" accept="image/"><br><br>
						<input name="submit" type="submit" value="Submit" class="button">
						</form><br><br>
						<a href="teacher_data.php">Visit Database</a>
					</div>
				</body>
		<?php }else {
			header ('Location:Login.php');
			exit();
		}

		 ?>
</html>

<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST"){

//--------------------updating name-------------------
		if (!empty($_POST["name"])){
			$sql = "update t_registration set name='".$_POST["name"]."' where id='".$_POST["id"]."'";
			if (mysqli_query($connectivity, $sql)){
				echo "Success"."<br/>";
			}
			else {
				echo "Not successful"."<br/>";
			}
		}
		else{
			$empty = true;
		}

//------------updating email-----------------

		if (!empty($_POST["email"])){
			if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
					$sql = "update t_registration set email='".$_POST["email"]."' where id='".$_POST["id"]."'";
					if (mysqli_query($connectivity, $sql)){
						echo "Success";
					}
					else {
						echo "Not successful"."<br/>";
					}
			}else {
				echo "Invalid email format"."<br/>";
			}
		}
		else{
			$empty = true;
		}

//-------------------updating password-------------

		if (!empty($_POST["password"])){
			$sql = "update t_registration set password='".$_POST["password"]."' where id='".$_POST["id"]."'";
			if (mysqli_query($connectivity, $sql)){
				echo "Success"."<br/>";
			}
			else {
				echo "Not successful"."<br/>";
			}
		}
		else{
			$empty = true;
		}
	

//--------------------updating course--------------


		if (!empty($_POST["department"])){
			$sql = "update t_registration set department='".$_POST["department"]."' where id='".$_POST["id"]."'";
			if (mysqli_query($connectivity, $sql)){
				echo "Success"."<br/>";			}
			else {
				echo "Not successful"."<br/>";
			}
		}
		else{
			$empty = true;
		}

	
//--------------------updating address------------


		if (!empty($_POST["address"])){
			$sql = "update t_registration set address='".$_POST["address"]."' where id='".$_POST["id"]."'";
			if (mysqli_query($connectivity, $sql)){
				echo "Success"."<br/>";
			}
			else {
				echo "Not successful"."<br/>";
			}
		}
		else{
			$empty = true;
		}

//------------------updating salary-----------------------------------
		if (!empty($_POST["salary"])){
			if (!preg_match('/^[0-9]*$/', $salary)){ 

        
				$sql = "update t_registration set salary='".$_POST["salary"]."' where id='".$_POST["id"]."'";
				if (mysqli_query($connectivity, $sql)){
					echo "Success"."<br/>";
				}
				else {
					echo "Not successful"."<br/>";
				}
			}else{
				echo "Only numbers allowed"."<br/>";
			}
		}
		else{
			$empty = true;
		}
//--------------------updating image-----------------------

		if (! empty($_FILES["image"]["name"])){
				$currentDirectory=getcwd(); // it wii give the working current directory
				

		        $uploadDirectory="/Image/"; // folder where images are stored
		        $error=[];
		        $fileExtensionArray=['jpeg','png','jpg'];
		        $fileName=$_FILES["image"]["name"];
		        $fileSize=$_FILES["image"]["size"];
		        $fileTempName=$_FILES["image"]["tmp_name"];
		         
		        $fileType=$_FILES["image"]["type"];
		        $extension=explode('.',$fileName);
		        $fileExtension=strtolower(end($extension));
		        $uploadPath=$currentDirectory.$uploadDirectory.basename($fileName);
		       
		         
		        if(isset($_POST["submit"]))
		        {
		            if(!in_array($fileExtension,$fileExtensionArray))
		            {
		                	echo "You can only upload jpeg,jpg,png image"."<br/>";
		                
		                    exit();
		               
		            }
		        }
		            
		            
		            if(empty($error))
		            {
		                
		                 if(move_uploaded_file($fileTempName,$uploadPath)) // upload the image to destination folder
		                {
		                    echo "Image has been uploded to the folder"."<br/>";
		                }
		                else
		                    echo "Image has not been uploded to the folder"."<br/>";  
		            }
		   
		       	$sql="update t_registration set image='".$fileName."' where id=".$_POST["id"]."";

		        if(mysqli_query($connectivity,$sql))// store the image in database
		        {
		            echo "image is stored in database"."<br/>";
		        }
		        else
		        {
		            echo "image is not stored in database"."<br/>";
		        }
		}
		
//--------------------------------------		
	}
?>