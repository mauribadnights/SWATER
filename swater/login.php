<?php
session_start();

require_once "db.php";

if(isset($_SESSION['user_id'])!="") {
    header("Location: dashboard.php");
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $username. "' and password = '" . md5($password). "' OR username = '" . $username. "' and password = '" . md5($password). "'");
   if(!empty($result)){
        if ($row = mysqli_fetch_array($result)) {
            $_SESSION['user_id'] = $row['uid'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_surname'] = $row['surname'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['extra'] = $row['extra'];
            $_SESSION['residents'] = $row['residents'];
            $_SESSION['washingmachines'] = $row['washingmachines'];
            $_SESSION['sinks'] = $row['sinks'];
            $_SESSION['toilets'] = $row['toilets'];
            $_SESSION['dishwashers'] = $row['dishwashers'];
            $_SESSION['showers'] = $row['showers'];
            $_SESSION['bathtubs'] = $row['bathtubs'];
            $_SESSION['searched'] = "";
            $_SESSION['tot_sensors'] = $row['tot_sensors'];



            header("Location: dashboard.php");
        }
    }else {
        $error_message = "Incorrect Email/Username or Password!!!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>SWATER - Login</title>
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
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<span class="login100-form-title">
						Member Login
					</span>

          <div class="form-group ">
              <label>Username / Email</label>
              <input type="text" name="username" class="form-control" value="" maxlength="50" required="">
          </div>

          <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control" value="" maxlength="20" required="">
          </div>

          <input type="submit" class="btn btn-primary" name="login" value="submit">

					<div class="text-center p-t-136">
						<a class="txt2" href="registration.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
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
