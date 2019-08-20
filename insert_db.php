<?php
    //importing db.php
    require('db_connect.php');


//----------------------Error Validation------------------------------------

    //checking the validation of the user entry
    $email = $_POST['email'];
    // Validate e-mail
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $_SESSION["email_error"] = ""; 

    }
    else {
        if ($_SESSION["type"] == "teacher"){
            $_SESSION["email_error"] = "Please use correct email format.";
            header('Location:Registration_teacher.php?email=invalid');
            exit();
        }else{
            $_SESSION["email_error"] = "Please use correct email format.";
            header('Location:Registration_student.php?email=invalid');
            exit();
        }
    }

    //checking the salary, if it is numbers
    if ($_SESSION["type"] == "teacher"){
        $salary = $_POST['salary'];

        //preg_match searches for number in any pattern and returns boolean value
        if (!preg_match('/^[0-9]*$/', $salary)){ 
            header('Location:Registration_teacher.php?salary=onlynumbers');
            $_SESSION["format_error"] = "Only numbers allowed";
            exit();
        }
        else{
            $_SESSION["format_error"] = "";
        }

    }

//------------------------------------------------------------






//-----------------Checking if the account already exists---------

    //------------For Students---------------------

    if ($_SESSION["type"] == "student"){
        $sql = "select * from s_registration";
        $result = mysqli_query($connectivity,$sql);
        $success = 0;
        while ($row = mysqli_fetch_assoc($result)){

            if (($_POST['name'] == $row['name']) or ($_POST['email'] == $row['email'])){
                $success += 1;
            }

            else {
                $success += 0;
                }
        }

        if ($success == 0){
            $_SESSION["account"] = "";
        }
        else{
            header('Location:Registration_student.php?account=already exists');
            $_SESSION["account"] = "An account with this name or email already exists!";
            exit();
        }
        

        //----------For Teachers-----------

    }else{
        $sql = "select * from t_registration";
        $result = mysqli_query($connectivity,$sql);
        $success = 0;
        while ($row = mysqli_fetch_assoc($result)){

            if (($_POST['name'] == $row['name']) or ($_POST['email'] == $row['email'])){
                $success += 1;
            }

            else {
                $success += 0;
                }
        }

        if ($success == 0){
            $_SESSION["account"] = "";
        }
        else{
            header('Location:Registration_teacher.php?account=already exists');
            $_SESSION["account"] = "An account with this name or email already exists!";
            exit();
        } 
    }





//-------------------------Database-----------------------------

     //checking connectivity
    if ($connectivity){
        echo "# Connection established"."<br/>";
    }
    else{
        die ("not connected".mysqli_error());
    }

    //adding the values to the database
    $key=array_keys($_POST);

    if ($_SESSION["type"] == "student"){
        $query="insert into s_registration(";
    }else{
        $query="insert into t_registration(";
    }
    for($i=0;$i<(count($key))-1;$i++)
        {
            $query=$query.$key[$i].",";
            
        }
    $query=substr($query,0,-1).")";
    $query=$query." values (";

    for($i=0;$i<(count($key))-1;$i++)
        {
            $query=$query."'".mysqli_real_escape_string($connectivity,$_POST[$key[$i]])."'".",";
            
        }
    $query=substr($query,0,-1).")";
    echo "1. ".$query."<br/>";

    //---------------ImageUpload-----------

    $currentDirectory=getcwd(); // it will give the working current directory
    

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
                $_SESSION["extension"]="You can only upload jpeg,jpg,png image";
                if ($_SESSION["type"] == "student"){
                    header('Location:Registration_student.php');
                    exit();
                }
                else{
                    header('Location:Registration_teacher.php');
                    exit();
                }
            }
            
            
            if(empty($error))
            {
                
                 if(move_uploaded_file($fileTempName,$uploadPath)) // upload the image to destination folder
                {
                    echo "2. Image has been uploded to the folder"."<br/>";
                }
                else
                    echo "2. Image has not been uploded to the folder"."<br/>";  
            }
        }


        
    //checking if data has been inserted
    if(mysqli_query($connectivity,$query))
    {
        $_SESSION['message']="data is inserted";
        echo "3. Data is inserted"."<br/>";
        //header("Location:ab.php");
    }
    else
    {
        echo mysqli_error($connectivity);
    } 
    


        //----------Inserting image in database------

        $id = mysqli_insert_id($connectivity);

        if ($_SESSION["type"] == "student"){
            $sql="update s_registration set image='".$fileName."' where id=$id"; 
        }else{
            $sql="update t_registration set image='".$fileName."' where id=$id";
        }
        if(mysqli_query($connectivity,$sql))// store the image in database
        {
            echo "4. Image is stored in database"."<br/>";
        }
        else
        {
            echo "4. Image is not stored in database"."<br/>";
        }


   mysqli_close($connectivity);
        
?>

<!DOCTYPE html>
<html>
<head>
    <title>Database</title>
</head>
<body>
    <a href="Login.php">Go to Login</a>
</body>
</html>

