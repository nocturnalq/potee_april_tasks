<?php
	include '../non-account-redirect.php';
	$id = $_GET['id'];
	$result = mysqli_query($mysql, "SELECT * FROM `users_info` WHERE `id` = '$id'");
	$user = mysqli_fetch_assoc($result);
	if ($user == null) {
		header('Location: /portal');
		exit();
	}
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

	<section class="profile-section">
		<div class="block-avatar">
			<div class="avatar">
				<img class="avatar-pic" src="../profile/avatars/<?php echo($_GET['id'])?>.png">
			</div>
			<h1 class="username"><?php
			$id = $_GET['id'];
			$result = mysqli_query($mysql, "SELECT * FROM `users_info` WHERE `id` = '$id'");
			$user = mysqli_fetch_assoc($result);
			if ($user == null) {
				header('Location: /portal');
				exit();
			}
			echo($user['login']);?></h1>

		</div>

		<div class="profile-post-form">
			<div class="worker-posts-area">
			<?php
				$id = $_GET['id'];
				$result = mysqli_query($mysql, "SELECT * FROM `users_posts` WHERE `id` = '$id'");
				$post = mysqli_fetch_assoc($result);
				if ($post == null) {
					echo("<div class='profile-post-body-nothing'>there's nothing here</div>");
				}else{
					echo("<div class='profile-post-body'>".$post['post']."</div>");
					while($row = mysqli_fetch_assoc($result)){
					    echo("<div class='profile-post-body'>".$row['post']."</div>");
				    }
				}
			?>
			</div>

		</div>

		<div class="profile-settings">
			<div><a href="/portal/profile?id=<?php echo($_SESSION['account'])?>">Write a post</a></div>
			<div><a href="/portal/employees">Back to the list of workers</a></div>
		</div>
	</section>

	<?php
		include('../footer.php');
	?>
</body>
</html>