<?php
  require_once "db.php";

  $water = $_GET['water'];
  $uid = $_GET['uid'];
  $table_name = $uid . "data";

  $query = "
  INSERT INTO `".$table_name."`(water_in)
  VALUES ('".$water."')
  ";
  mysqli_query($conn, $query);
?>
