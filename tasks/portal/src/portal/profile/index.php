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
				<img class="avatar-pic" src="avatars/<?php echo($_GET['id'])?>.png">
			</div>
			<h1 class="username"><?php $id = $_GET['id'];
			$result = mysqli_query($mysql, "SELECT * FROM `users_info` WHERE `id` = '$id'");
			$user = mysqli_fetch_assoc($result);
			if ($user == null) {
				header('Location: /portal');
				exit();
			}
			echo($user['login']);?></h1>
			
			<h2 class="username" id="card"><?php echo($user['card']);?></h2>
		</div>

		<div class="profile-post-form">
			<br>
			<form method="post" enctype="multipart/form-data" action="/portal/profile/post-logic.php?id=<?php echo($_GET['id'])?>">
				<textarea class="user-post-textarea" name="post-text"></textarea>
				<br>
				<input class="projects-btn" type="submit" value="Опубликовать" />
			</form>

			<div class="posts-area">
			<?php
				$id = $_GET['id'];
				$result = mysqli_query($mysql, "SELECT * FROM `users_posts` WHERE `id` = '$id'");
				$post = mysqli_fetch_assoc($result);
				if ($post == null) {
					echo("<div class='profile-post-body'>there's nothing here</div>");
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
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<div class="spoiler">
				<div class="button">Change username</div>
				<div class="content">
					<form action="changeName.php?id=<?php echo($_GET['id'])?>" method="POST">
						<input class="change-name-input" type="text" name="changeName">
						<input class="change-name-button" type="submit" name="changeNameSubmit">
					</form>
				</div>
			</div>
			<div class="spoiler">
				<div class="button">Change avatar</div>
				<div class="content">
					<form class="uploadFiles-form" method="post" enctype="multipart/form-data" action="changeAvatar.php?id=<?php echo($_GET['id'])?>">
		                <span class="uploadFiles-span">Выберите файл:</span>
		                <input type="file" name="filename" size="10" /><br /><br />
		                <input class="avatar-btn" type="submit" value="Загрузить" />
		            </form>
				</div>
			</div>
			<div class="spoiler">
				<div class="button">Delete account</div>
				<div class="content">
					<form action="deleteAccount.php" method="POST">
						<input class="change-name-button" type="submit" name="changeNameSubmit">
					</form>
				</div>
			</div>
		</div>
	</section>

	<?php
		include('../footer.php');
	?>
</body>
<script>$(document).on('click', '.spoiler .button', function(){
			let parent = $(this).closest('.spoiler'),
			button = parent.find('.button'),
			content = parent.find('.content');
			if(content.css('display') === 'none'){
				content.fadeIn();
			} else{
				content.fadeOut();
			}
		});
</script>
</html>
