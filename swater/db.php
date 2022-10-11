<?php
    $servername='localhost';
    $username='root';
    $password='group270';
    $dbname = "engineeringdesign";
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
      if(!$conn){
          die('Could not Connect MySql Server:' .mysql_error());
        }
?>
