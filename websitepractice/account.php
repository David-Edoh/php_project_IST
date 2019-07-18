<?php
	session_start();
	require 'dbconfig/config.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="css/bootstrap-4.3.1-dist/css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Account</title>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">IST</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
    </div>
  </div>
</nav>

        <div class = "container">
        <hr/>
            <h1>Welcome!</h1>
            <hr/>
            <div class = "col-md-5">
                <?php
                $username = $_SESSION['username'];

                $query= "SELECT * FROM `users` WHERE (`username` = \"$username\")";
                $query_run = mysqli_query($con,$query);

                while($row = mysqli_fetch_array ($query_run))
				{
                    echo '<div class="forms"> <p>&nbsp;</P><div class="passportcontainer" align="left"><img src ="'.$row["targetFile"].'"width="80" height="80"></div>';
                    echo ('<div class="" align = "left"> First Name: '
                                    .$row["firstName"]. 
                                    '</div><div class="" align = "left"> Username: '
                                    .$row["userName"].
                                    '</div><div class="" align = "left"> Address:   '
									.$row["address"]. 
                                    '</div><div class="" align = "left"> Phone Number:   '
                                    .$row["phoneNumber"].
                                    ' </div><div class="" align = "left">E-Mail: '
									.$row["email"].' </div>');
                }
                ?>
            </div>
            
            <hr/>
            <form action="account.php" method = "post">
            <a class="btn btn-warning" href="login.php" role="button">Log out</a>
            <!-- <button  name="submit_btn" type="submit" value="Submit" class = "btn btn-danger" >Delete</button> -->
            <!-- <button name="submit_btn_up" type="submit" value="Submit" class = "btn btn-default">Update</button> -->
            </form>

            <?php
            // if(isset($_POST['submit_btn']))
            // {
            //     $query= "DELETE FROM `users` WHERE (`username` = \"$username\")";
            //     $query_run = mysqli_query($con,$query);

            //     if($query_run)
            //     {
            //         $_SESSION['username'] = '';
            //         $url = 'login.php';
            //         echo '<meta http-equiv="refresh" content="1;'.$url.'">';
            //     }
            // }

            // if(isset($_POST['submit_btn_up']))
            // {
            //     $username = $_SESSION['username'];

            //     $query= "SELECT * FROM `users` WHERE (`username` = \"$username\")";
            //     $query_run = mysqli_query($con,$query);

            //     while($row = mysqli_fetch_array ($query_run))
			// 	{
            //         echo '<div class="forms"> <p>&nbsp;</P><div class="passportcontainer" align="left"><img src ="'.$row["targetfile"].'"width="80" height="80"></div>';
            //         echo ('<form>
            //             <input />
            //         </form>');
            //     }
            // }

            ?>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>