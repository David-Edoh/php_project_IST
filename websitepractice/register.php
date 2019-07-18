<?php
	require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
    <script type="text/javascript">

        function PreviewImage() {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("imglink").files[0]);

            oFReader.onload = function (oFREvent) {
                document.getElementById("uploadPreview").src = oFREvent.target.result;
            };
        };

    </script>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="css/bootstrap-4.3.1-dist/css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
<body>
<?php include 'header.php'; ?>

    <div class = "container">
    <hr/>
    <h2>Registration Page</h2>
    <hr/>
        <div class = "row">
            <div class = "col-md-8">
               
                    <form name = "regform" action = "register.php"  method = "post" enctype="multipart/form-data">
                    
                    <img id="uploadPreview" src="images/avatar.png"  width="150" height="150"/>
                    
                    <br>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="imglink" name="imglink" accept=".jpg,.jpeg,.png" onchange="PreviewImage();" required>
                        <label class="custom-file-label" for="customFile">Choose a Picture</label>
                    </div>
                    
                    
                    <hr/>
                    
                    <div class = "form-group row">
                            <label for="firstname" class="col-lg-3 col-form-label">First Name :</label>
                            <div class="col-lg-9">
                            <input type="text" class="form-control" id = "firstname" name = "firstName" placeholder = "First Name" required/>
                            </div>
                    </div>
                    
                    <div class = "form-group row">
                            <label for="username" class="col-lg-3 col-form-label">Username :</label>
                            <div class="col-lg-9">
                            <input type="text" id="username" class="form-control" name = "userName" placeholder = "Username" required/>
                            </div>
                    </div>

                    <div class = "form-group row">
                            <label for="password" class="col-lg-3 col-form-label">Password :</label>
                            <div class="col-lg-9">        
                            <input type="password" id = "password" class="form-control" name = "password" placeholder = "Password" required/>
                            </div>    
                    </div>
                    
                    <div class = "form-group row">
                            <label for="address" class="col-lg-3 col-form-label">Address :</label>
                            <div class="col-lg-9">
                    <input type="text" class="form-control" id = "address" name = "address" placeholder = "Address" required/>
                    </div>
                    </div>
                    
                    <div class = "form-group row">
                            <label for="phoneNumber" class="col-lg-3 col-form-label">Phone Number :</label>
                            <div class="col-lg-9">
                            <input type="text" class="form-control" id = "phoneNumber" name = "phoneNumber" placeholder = "Phone Number" required/>
                        </div>
                    </div>
                    
                    <div class = "form-group row">
                            <label for="email" class="col-lg-3 col-form-label">E-Mail :</label>
                            <div class="col-lg-9">
                    <input type="text" class="form-control" id = "email" name = "email" placeholder = "E-Mail" required/>
                    </div>
                    </div>
                
                
                <button name="submit_btn" type="submit" value="Submit" class="btn btn-primary btn-modify">submit</button>
                <a class="btn btn-default" href="login.php" role="button">login page</a>

                </form>

        <?php
			if(isset($_POST['submit_btn']))
			{
				
                    $firstName = $_POST['firstName'];
                    $userName = $_POST['userName'];
                    $password = $_POST['password'];
                    $address = $_POST['address'];
                    $phoneNumber = $_POST['phoneNumber'];
                    $email = $_POST['email'];
                    
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    
                    
                    $img_name = $_FILES['imglink']['name'];
                    $img_size =$_FILES['imglink']['size'];
                    $img_tmp =$_FILES['imglink']['tmp_name'];
                    $directory = 'uploads/';
                     $target_file = $directory.$img_name;


                    if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) 
                    {
                        echo '<script type="text/javascript"> alert("Only latters are allowed in the name field...") </script>';
                    }
                    else
                    {
                        if (!preg_match('/^[0-9]*$/', $phoneNumber)) {
                            echo '<script type="text/javascript"> alert("Enter a valid phone number...") </script>';
                        } 
                        else 
                        {
                            if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
                            {
                                 $checkquery = "SELECT * FROM `users` WHERE `userName` = '$userName' OR `email` = '$email'";
                                 $runcheck = mysqli_query($con,$checkquery);

                                if(!mysqli_num_rows($runcheck) > 0)
                                {
                                    $query= "INSERT INTO `users` (`id`, `firstName`, `userName`, `password`, `address`, `phoneNumber`, `email`, `targetFile`) VALUES('', '$firstName','$userName','$hashedPassword','$address','$phoneNumber','$email','$target_file')";
                                    $reg_query = mysqli_query($con,$query);
                                    
                                    
                                    if($reg_query)
                                    {
                                        move_uploaded_file($img_tmp,$target_file); 	
                                        echo '<script type="text/javascript"> alert("User Registered Successfully..") </script>';
                                        $url = 'login.php';
                                        echo '<meta http-equiv="refresh" content="1;'.$url.'">';
                                    }
                                    else
                                    {
                                        echo '<script type="text/javascript"> alert("Error! User not Registered..") </script>';
                                    }
                                }
                                else
                                {
                                    echo '<script type="text/javascript"> alert("Username/E-mail Already in Use...") </script>';
                                }
                            
                            }
                            else
                            {
                                echo '<script type="text/javascript"> alert("Invalid Email...") </script>';
                            }

                        }
                    }
                 
            }
			?>

            </div>

            <div class = "col-md-5">
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>