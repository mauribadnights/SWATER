<?php
    require_once "db.php";
    session_start();
    if(!$conn){
      die('Could not Connect MySql Server:' .mysql_error());
    }
    if(isset($_SESSION['user_id']) =="") {
        header("Location: login.php");
    }
    $isthereresult = 0;

    if(isset($_POST['search'])){
      $select = mysqli_query($conn, "SELECT * FROM users WHERE username = '".$_POST['search']."'");
      if (mysqli_num_rows($select) > 0){
        $isthereresult = 1;
        while($row = mysqli_fetch_assoc($select)) {
          $_SESSION['searched'] = $row['uid'];
          header("Location: profile.php");

        }
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
    <div class="topnav">
      <ul>
       <li><a href="dashboard.php">Dashboard</a></li>
       <li><a class="active" href="friends.php">Find friends</a></li>
       <li><a href="linkedit.php">Edit Link</a></li>
       <li><a href="tips.php">Tips</a></li>
       <li class="rightsidebar"><a class="red" href="logout.php">Logout</a></li>
       <li class="rightsidebar"><a href="registrationextra.php">Edit my data</a></li>
     </ul>
    </div>
    <div class="limiter">
		<div class="container-login100">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="text" class="friendsearch" name="search" placeholder="Searh for friends using their usernames"><br>
      </form>
    </div>
    </div>



</body>
</html>
