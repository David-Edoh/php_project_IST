<?php
    session_start();
	require 'dbconfig/config.php';
?>

<html>
    <head>
            <title>Login</title>
            <link rel="stylesheet" href="css/bootstrap-4.3.1-dist/css/bootstrap.css">
            <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <?php include 'header.php'; ?>

        <div class = "container">
            <div>
            <hr/>
                    <h2>Login Page</h2>
                    <hr/>
                    <div class = "col-md-5">
                        <form action="login.php" method="post">
                        <div class = "form-group row">
                            <label for="username" class="col-lg-3 col-form-label">Username :</label>
                            <div class="col-lg-9">
                                <input type="text" id = "username" class = "form-control" id="username" name = "username" placeholder = "Username">
                            </div>
                        </div>
                        <div class = "form-group row">
                            <label for="password" class="col-lg-3 col-form-label">Password :</label>
                            <div class="col-lg-9">
                                <input type="password" id = "password" class = "form-control" id="password" name = "password" placeholder = "Password">
                            </div>
                        </div>

                        <button name="submit_btn" type="submit" value="Submit" class = "btn btn-primary">Login</button>
                        <a class="btn btn-default" href="register.php" role="button">Sign Up</a>
                        </form>

                        <?php
                            if(isset($_POST['submit_btn']))
                            {
                                
                                   
                                    $username = $_POST['username'];
                                    $password = $_POST['password'];
                                   
                                    $query= "SELECT * FROM `users` WHERE `username` = \"$username\"";
                                    $findUserQuery = mysqli_query($con,$query);
                                    
                                    
                                    if($findUserQuery)
                                        {
                                            $passwordQuery = mysqli_fetch_array ($findUserQuery);
                                            //$resultcount = mysqli_num_rows($findUserQuery);
                                            if(password_verify($password, $passwordQuery["password"]))
                                            {
                                                $_SESSION['username'] = $username;
                                                $url = 'account.php';
			                                    echo '<meta http-equiv="refresh" content="1;'.$url.'">';
                                            }
                                            else
                                            {
                                                echo '<script type="text/javascript"> alert("Invalid Credentials...") </script>';
                                            }
                                        }
                                        else
                                        {
                                            echo '<script type="text/javascript"> alert("User Not Registered...") </script>';
                                        }
                            }

                        ?>
                    </div>
                </div>
            </div>
            <?php include 'footer.php'; ?>
    </body>
</html>