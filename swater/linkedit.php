<?php

    require_once "db.php";
    session_start();

    if(isset($_SESSION['user_id']) =="") {
        header("Location: login.php");
    }

    $table_name = mysqli_real_escape_string($conn, $_SESSION['user_id']);
    $table_name .= "data";
    $sql_table_request = "
      CREATE TABLE `".$table_name."` (time TIMESTAMP NOT NULL , water_in INT NOT NULL) ENGINE = InnoDB";

    if (isset($_POST['outsensors'])) {
      mysqli_query($conn, "
      DELETE FROM sensor_info
      WHERE uid = '".$_SESSION['user_id']."'
      ");
      mysqli_query($conn, "
      DROP TABLE `".$table_name."`
      ");
      if ($_POST['outsensors'] <= 0){
        $_POST['outsensors'] = 1;
      }
      mysqli_query($conn, "
      UPDATE users SET tot_sensors = '".$_POST['outsensors']."' WHERE uid = '".$_SESSION['user_id']."';
      ");
      mysqli_query($conn, $sql_table_request);
      $_SESSION['tot_sensors'] = $_POST['outsensors'];
      $_SESSION['curr_sensor'] = 1;
      for ($out_sensor=1; $out_sensor<=$_POST['outsensors']; $out_sensor++){
        $new_col_name = "out_sensor_" . strval($out_sensor);
        mysqli_query($conn, "ALTER TABLE `".$table_name."` ADD $new_col_name VARCHAR(30)");
      }
      header("Location: linkregister2.php");
    }
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
        <li><a class="active" href="linkedit.php">Edit Link</a></li>
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
              <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post'>
                <div class="form-group">
                    <label>Number of out-sensors</label>
                    <input type="number" name="outsensors" class="form-control" value="" maxlength="50" required=true>
                </div>
                <input type='submit' class="btn btn-primary" value="Next">
              </form>
            </div>
        </div>
    </div>
  </div>
</div>
</body>
</html>
