<?php
	include '../non-account-redirect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Waxom</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../css/main2.css">
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@600&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;1,300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">

</head>
<body>
	<?php
		include('../header.php');
	?>

	<div class="post-name">
		<h2>Posts.</h2>
	</div>

	<div class="posts-area">
		<?php
			$result = mysqli_query($mysql, "SELECT * FROM `users_posts`");
			$post = mysqli_fetch_assoc($result);

			$userId = $post['id'];
			$userResult = mysqli_query($mysql, "SELECT * FROM `users_info` WHERE `id` = '$userId'");
			$username = mysqli_fetch_assoc($userResult);
			
			if ($post == null) {
				echo("<div class='post-body'>there's nothing here</div>");
			}else{
				echo("<div class='post-username'><a href='#'>".$username['login']."</a></div><div class='post-body'>".$post['post']."</div>");
				while($row = mysqli_fetch_assoc($result)){
					$userId = $row['id'];
					$userResult = mysqli_query($mysql, "SELECT * FROM `users_info` WHERE `id` = '$userId'");
					$username = mysqli_fetch_assoc($userResult);
				    echo("<div class='post-username'><a href='#'>".$username['login']."</a></div><div class='post-body'>".$row['post']."</div>");
			    }
			}
		?>
	</div>

	<?php
		include('../footer.php');
	?>
</body>
</html>