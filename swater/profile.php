<?php
  require_once "db.php";
  session_start();
  if(!$conn){
    die('Could not Connect MySql Server:' .mysql_error());
  }
  if(isset($_SESSION['user_id']) =="") {
      header("Location: login.php");
  }
  if($_SESSION['searched'] == $_SESSION['user_id']){
    header("Location: dashboard.php");
  }

  $select = mysqli_query($conn, "SELECT * FROM users WHERE uid = '".$_SESSION['searched']."'");
  if (mysqli_num_rows($select) > 0){
    while($row = mysqli_fetch_assoc($select)) {
      $searched_id = $row["uid"];
      $searched_name = $row["name"];
      $searched_surname = $row["surname"];
      $searched_mail = $row["email"];
    }
  }

  if (isset($_POST['follow'])) {
    $select2 = mysqli_query($conn, "SELECT * FROM follows WHERE followerID = '".$_SESSION['user_id']."' AND followedID='".$_SESSION['searched']."' ");
    if (mysqli_num_rows($select2) > 0){
      $error_already_following = "You already follow this user.";
    } else {
      mysqli_query($conn, "
      INSERT INTO follows(followerID, followedID)
      VALUES('" . $_SESSION['user_id'] . "', '" . $_SESSION['searched'] . "')
      ");
    }
  }

  if (isset($_POST['unfollow'])){
    $select3 = mysqli_query($conn, "SELECT * FROM follows WHERE followerID = '".$_SESSION['user_id']."' AND followedID='".$_SESSION['searched']."' ");
    if (mysqli_num_rows($select3) == 0){
      $error_not_following = "You don't follow this user.";
    } else {
      mysqli_query($conn, "DELETE FROM follows WHERE followerID = '".$_SESSION['user_id']."' AND followedID='".$_SESSION['searched']."'");
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
        <li><a href="friends.php">Find friends</a></li>
        <li><a href="linkedit.php">Link sensor</a></li>
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
                      <h5 class="card-title"><?php echo $searched_name?> <?php echo $searched_surname?></h5>
                      <p class="card-text">Email : <?php echo $searched_mail?></p>
                      <p class="card-text">User ID : <?php echo $_SESSION['searched']?></p>
                      <br>
                      <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post'>
                      <input type='hidden' name='follow' value='1'>
                      <input type='submit' class='btn btn-primary' value='Follow'>
                      <span class="text-danger"><?php if (isset($error_already_following)) echo $error_already_following; ?></span>
                      </form>
                      <br style="display:block; content:''; margin-top:4px">
                      <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post'>
                      <input type="hidden" name='unfollow' value='1'>
                      <input type='submit' class="btn btn-primary" value="Unfollow" style="background-color:#FF4444; border-color:#FF4444">
                      <span class="text-danger"><?php if (isset($error_not_following)) echo $error_not_following; ?></span>
                      </form>
                    </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</body>
</html>
