<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>account</title>
	</head>
	<body>
		<?php
			include '../db.php';
			$id = $_GET['id'];
			$result = mysqli_query($mysql, "SELECT * FROM `users_info` WHERE `id` = '$id'");
			$user = mysqli_fetch_assoc($result);
			if ($user == null) {
				header('Location: /about');
				exit();
			}
			echo("<h4>".$user['login']."</h4>");
		?>
	</body>
</html>