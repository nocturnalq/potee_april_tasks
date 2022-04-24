<?php
	session_start();
	include '../non-account-redirect.php';

	$text = filter_var(trim($_POST['post-text']), FILTER_SANITIZE_STRING);
	$id = $_GET['id'];
	$result = mysqli_query($mysql, "INSERT INTO `users_posts` (`id`, `post`) VALUES ('$id', '$text');");
	header('Location: /portal/profile?id='.$user['id'].'');
?>