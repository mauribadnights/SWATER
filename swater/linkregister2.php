<?php

    require_once "db.php";
    session_start();

    if(isset($_SESSION['user_id']) =="") {
        header("Location: login.php");
    }


    $num_col = -1;
    $table_name2 = mysqli_real_escape_string($conn, $_SESSION['user_id']);
    $table_name2 .= "data";
    $number_of_out_sensors = mysqli_query($conn, "SELECT COUNT(column_name) FROM information_schema.columns WHERE table_name = '".$table_name2."'");
    while($row = mysqli_fetch_assoc($number_of_out_sensors)) {
      $num_col = $row['COUNT(column_name)'];
    }
    $num_col = $num_col - 2;
    if(isset($_POST['outsensorpin'])){
      mysqli_query($conn, "
      INSERT INTO sensor_info
      VALUES('" . $_SESSION['user_id'] . "', '" . $_SESSION['curr_sensor'] . "', '" . $_POST['outsensorname'] . "','" . $_POST['outsensorpin'] . "')
      ");
      $_SESSION['curr_sensor'] = $_SESSION['curr_sensor'] +1;

      if($_SESSION['curr_sensor']>$_SESSION['tot_sensors']){
        header("Location: dashboard.php");
    } else {
      header("Location: linkregister2.php");
    }
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
    <div class="limiter">
		<div class="container-login100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
              <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post'>
                <div class="form-group">
                  <div class="card">
                  <div class="card-body">
                  <h5 class="card-title">Sensor number <?php echo($_SESSION['curr_sensor']); ?>:</h5>
                  <label>GPIO Pin of this sensor:</label>
                  <input type="number" name="outsensorpin" class="form-control" value="" maxlength="50" required=true>
                  <label>Type of out:</label>
                  <input type="text" name="outsensorname" class="form-control" value="" maxlength="50" required=true>
                  </div></div>
                  <br>
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
