<?php
  session_start();
  require_once "db.php";

  if(isset($_SESSION['user_id']) =="") {
      header("Location: login.php");
  }


  if (isset($_POST['signup'])) {
      $residents = mysqli_real_escape_string($conn, $_POST['residents']);
      $washingmachines = mysqli_real_escape_string($conn, $_POST['washingmachines']);
      $sinks = mysqli_real_escape_string($conn, $_POST['sinks']);
      $toilets = mysqli_real_escape_string($conn, $_POST['toilets']);
      $showers = mysqli_real_escape_string($conn, $_POST['showers']);
      $bathtubs = mysqli_real_escape_string($conn, $_POST['bathtubs']);
      $dishwashers = mysqli_real_escape_string($conn, $_POST['dishwashers']);



      if(mysqli_query($conn, "
          UPDATE users
          SET residents = '" . $residents . "', washingmachines = '" . $washingmachines . "', sinks = '" . $sinks . "', toilets = '" . $toilets . "', dishwashers = '" . $dishwashers . "', showers = '" . $showers . "', bathtubs = '" . $bathtubs . "', extra = 1
          WHERE users.uid = '" . $_SESSION['user_id'] . "' ")) {
       header("location: logout.php");
       exit();

      } else {
         echo "Error: " . $sql . "" . mysqli_error($conn);
      }

      mysqli_close($conn);
  }

    if (isset($_POST['delete_account'])) {
      $delete_account_sql = "DELETE FROM users WHERE uid = '".$_SESSION['user_id']."'";
      mysqli_query($conn, $delete_account_sql);
      $table_name1 = mysqli_real_escape_string($conn, $_SESSION['user_id']);
      $table_name1 .= "data";
      mysqli_query($conn, "DROP TABLE `".$table_name1."`");
      header("Location: logout.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>SWATER - Registration</title>
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
<body style="">
  <div class="topnav">
    <ul>
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="friends.php">Find friends</a></li>
      <li><a href="linkedit.php">Edit Link</a></li>
      <li><a href="tips.php">Tips</a></li>
      <li class="rightsidebar"><a class="red" href="logout.php">Logout</a></li>
      <li class="rightsidebar"><a class="active" href="registrationextra.php">Edit my data</a></li>
   </ul>
  </div>
	<div class="limiter">
		<div class="container-login100">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <span class="login100-form-title">
            <br><br><br><br><br>
            EDIT MY DATA
          </span>
            <div class="form-group">
                <label>How many residents live in your house?</label>
                <input type="number" name="residents" class="form-control" value=<?php echo $_SESSION['residents'] ?> maxlength="3" required="">
            </div>

            <div class="form-group">
                <label>How many washing machines are there in your house?</label>
                <input type="number" name="washingmachines" class="form-control" value=<?php echo $_SESSION['washingmachines'] ?> maxlength="3">
            </div>

            <div class="form-group">
                <label>How many sinks are there in your house?</label>
                <input type="number" name="sinks" class="form-control" value=<?php echo $_SESSION['sinks'] ?> maxlength="3">
            </div>

            <div class="form-group ">
                <label>How many toilets are there in your house?</label>
                <input type="number" name="toilets" class="form-control" value=<?php echo $_SESSION['toilets'] ?> maxlength="3">
            </div>

            <div class="form-group">
                <label>How many dishwashers are there in your house?</label>
                <input type="number" name="dishwashers" class="form-control" value=<?php echo $_SESSION['dishwashers'] ?> maxlength="3">
            </div>

            <div class="form-group">
                <label>How many showers are there in your house?</label>
                <input type="number" name="showers" class="form-control" value=<?php echo $_SESSION['showers'] ?> maxlength="3">
            </div>

            <div class="form-group">
                <label>How many bathtubs are there in your house?</label>
                <input type="number" name="bathtubs" class="form-control" value=<?php echo $_SESSION['bathtubs'] ?> maxlength="3">
            </div>
            <br>
            <input type="submit" class="btn btn-primary" name="signup" value="Submit">
            <br>
            <font size="2">
            Note: After clicking submit you will be redirected to login again
          </font><br><br>
          </form>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <input type="hidden" class="btn btn-primary" name="delete_account">
              <input type="submit" class="btn btn-primary" name="delete_account" value="Delete Account" style="background-color:#FF4444; border-color:#FF4444">
            </form>
            <br><br><br><br><br>

			</div>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
