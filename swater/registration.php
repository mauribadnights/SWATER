<?php
  require_once "db.php";
  session_start();
  if(isset($_SESSION['user_id'])!="") {
    header("Location: dashboard.php");
  }
  $error = 0;
    if (isset($_POST['signup'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $surname = mysqli_real_escape_string($conn, $_POST['surname']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
        $select1 = mysqli_query($conn, "SELECT * FROM users WHERE username = '".$username."'");
        $select2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '".$email."'");
        if (mysqli_num_rows($select1)){
          $usernametaken_error = "This username is already registered";
          $error = 1;
        }
        if (mysqli_num_rows($select2)){
          $emailtaken_error = "This email is already registered";
          $error = 1;
        }
        if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
            $name_error = "Name must contain only alphabets and space";
            $error = 1;
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $email_error = "Please Enter Valid Email ID";
            $error = 1;
        }
        if(strlen($password) < 6) {
            $password_error = "Password must be minimum of 6 characters";
            $error = 1;
        }
        if($password != $cpassword) {
            $cpassword_error = "Password and Confirm Password doesn't match";
            $error = 1;
        }
        if ($error==0) {
            if(mysqli_query($conn, "
            INSERT INTO users(name, surname, username, email,password)
            VALUES('" . $name . "', '" . $surname . "', '" . $username . "','" . $email . "', '" . md5($password) . "')
            ")) {
            $result = mysqli_query($conn, "SELECT * FROM users WHERE username='".$username."'");
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
                $_SESSION['curr_sensor'] = 1;
              }
             header("location: linkregister.php");

            } else {
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }
        }
        mysqli_close($conn);
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
            Create an account
          </span>
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="" maxlength="50" required="">
                <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
            </div>

            <div class="form-group">
                <label>Surname</label>
                <input type="text" name="surname" class="form-control" value="" maxlength="50" required="">
                <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
            </div>

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="" maxlength="50" required="">
                <span class="text-danger"><?php if (isset($usernametaken_error)) echo $usernametaken_error; ?></span>
            </div>

            <div class="form-group ">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="" maxlength="50" required="">
                <span class="text-danger"><?php if (isset($emailtaken_error)) echo $emailtaken_error; ?></span>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="" maxlength="20" required="">
                <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="cpassword" class="form-control" value="" maxlength="8" required="">
                <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
            </div>
            <br><br><br>
            <input type="submit" class="btn btn-primary" name="signup" value="Submit">
            <a href="login.php" class="btn btn-default">Login</a>
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
