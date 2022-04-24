<?php
	session_start();
	include $_SERVER['DOCUMENT_ROOT'].'/db.php';
	$id = $_SESSION['account'];
	$result = mysqli_query($mysql, "SELECT * FROM `users_info` WHERE `id` = '$id'");
	$user = mysqli_fetch_assoc($result);
	if ($user == null) {
		header('Location: /');
		exit();
	}
?>