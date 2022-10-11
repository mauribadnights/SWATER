<?php
ob_start();
session_start();
if(isset($_SESSION['user_id'])) {
	session_destroy();

	unset($_SESSION['user_id']);
	unset($_SESSION['user_name']);
	unset($_SESSION['user_surname']);
	unset($_SESSION['user_email']);
	unset($_SESSION['extra']);
	unset($_SESSION['residents']);
	unset($_SESSION['washingmachines']);
	unset($_SESSION['sinks']);
	unset($_SESSION['toilets']);
	unset($_SESSION['dishwashers']);
	unset($_SESSION['showers']);
	unset($_SESSION['bathtubs']);
	unset($_SESSION['searched']);
	unset($_SESSION['tot_sensors']);
	unset($_SESSION['curr_sensor']);
	header("Location: login.php");
} else {
	header("Location: login.php");
}
?>
