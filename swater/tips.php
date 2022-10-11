<?php

    session_start();

    if(isset($_SESSION['user_id']) =="") {
        header("Location: login.php");
    }

#    if($_SESSION['extra'] == false) {
  #     header("Location: registrationextra.php");
#    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>SWATER - Profile</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/topbar.css">
<!--===============================================================================================-->
</head>
<body>
    <div class="topnav">
      <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="friends.php">Find friends</a></li>
        <li><a href="linkedit.php">Edit Link</a></li>
        <li><a class="active" href="tips.php">Tips</a></li>
        <li class="rightsidebar"><a class="red" href="logout.php">Logout</a></li>
        <li class="rightsidebar"><a href="registrationextra.php">Edit my data</a></li>
     </ul>
    </div>
    <div class="limiter">
		<div class="container-login100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $_SESSION['user_name']?> <?php echo $_SESSION['user_surname']?></h5>
                    <p class="card-text">Email : <?php echo $_SESSION['user_email']?></p>
                    <p class="card-text">User ID : <?php echo $_SESSION['user_id']?></p>
                    <br>
                    <a href="logout.php" class="btn btn-primary" style="background-color: red; border-color:red">Logout</a>
                    <?php
                      if($_SESSION['extra'] == false) {
                        echo '<a href="registrationextra.php" class="btn btn-primary">Add some extra info</a>';
                      }
                      if($_SESSION['extra'] == true) {
                        echo '<a href="registrationextra.php" class="btn btn-primary">Modify info</a>';
                      }
                    ?>
                  </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
</body>
</html>
