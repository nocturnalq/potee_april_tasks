<?php
	session_start();
	include '../non-account-redirect.php';

	$id = $_GET['id'];
	$newName = $_POST['changeName'];
	$query = mysqli_query($mysql, "UPDATE `users_info` SET `login` = '$newName' WHERE `id` = '$id'");
	header('Location: /portal/profile?id='.$user['id'].'');
?>