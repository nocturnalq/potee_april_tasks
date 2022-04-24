<?php
	session_start();
	include '../non-account-redirect.php';

	$id = $_SESSION['account'];
	$query = mysqli_query($mysql, "DELETE FROM `users_info` WHERE `id` = '$id'");
	$query2 = mysqli_query($mysql, "DELETE FROM `users_posts` WHERE `id` = '$id'");
	header('Location: /');
?>