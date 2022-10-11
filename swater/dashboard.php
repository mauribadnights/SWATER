<?php
    require_once "db.php";
    session_start();

    if(isset($_SESSION['user_id']) =="") {
        header("Location: login.php");
    }

    if (isset($_POST['search'])) {

    }

    if($_SESSION['tot_sensors'] == 0) {
      header("Location: linkregister.php");
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
        <li><a class="active" href="dashboard.php">Dashboard</a></li>
        <li><a href="friends.php">Find friends</a></li>
        <li><a href="linkedit.php">Edit Link</a></li>
        <li><a href="tips.php">Tips</a></li>
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
                    <p class="cart-text">Username: <?php echo $_SESSION['username'] ?></p>
                    <p class="card-text">Email : <?php echo $_SESSION['user_email']?></p>
                    <p class="card-text">User ID : <?php echo $_SESSION['user_id']?></p><br>
                    <h6>You have spent <?php
                      $table_name1 = $_SESSION['user_id'] . "data";

                      $water_db_result = mysqli_query($conn,"
                        SELECT SUM(water_in) AS tot_water
                        FROM `".$table_name1."`
                      ");


                      if ($row1 = mysqli_fetch_array($water_db_result)) {
                        if (!is_null($row1['tot_water'])){
                          echo sprintf("%.2f", $row1['tot_water']);;
                        } else {
                          echo 0;
                        }
                      }

                    ?>L of water so far.</h6>
                    <br>

                    <?php
                      if($_SESSION['extra'] == false) {
                        echo '<a href="registrationextra.php" class="btn btn-primary">Add information</a><br><br>';
                        echo '<b>Adding information lets us show you more detailed statistics</b>';
                      }
                    ?>
                  </div>
                </div>
                <br>
                <?php
                  $select4 = mysqli_query($conn, "SELECT * FROM follows WHERE followerID = '".$_SESSION['user_id']."' ");
                  $total_following = mysqli_num_rows($select4);
                  for ($x=0; $x<$total_following; $x++){
                      while($row = mysqli_fetch_assoc($select4)) {
                        $followed_id = $row["followedID"];
                        $select5 = mysqli_query($conn, "SELECT * FROM users WHERE uid = '".$followed_id."' ");
                        while($row = mysqli_fetch_assoc($select5)){
                        $searched_id = $row["uid"];
                        $searched_name = $row["name"];
                        $searched_surname = $row["surname"];
                        $searched_mail = $row["email"];
                        }
                      echo('
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title"> '.$searched_name.' '.$searched_surname.' </h5>
                            <p class="card-text">Email : '.$searched_mail.'</p>
                            <p class="card-text">User ID : '.$searched_id.'</p>
                            <br>
                          </div>
                        </div>
                        <br>
                        ');
                      }
                }
                ?>


            </div>
        </div>
    </div>
  </div>
</div>
</body>
</html>
