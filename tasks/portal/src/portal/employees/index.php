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

	<div class="workers-list">
		<?php
			$result = mysqli_query($mysql, "SELECT * FROM `users_info`");
			$users = mysqli_fetch_assoc($result);
			echo("<div class='workers-list-body'><a href='employee-profile.php?id=".$users['id']."'>".$users['login']."</a></div>");
			while($row = mysqli_fetch_assoc($result)){
		    	echo("<div class='workers-list-body'><a href='employee-profile.php?id=".$row['id']."'>".$row['login']."</a></div>");
			}
		?>
	</div>

	<?php
		include('../footer.php');
	?>
</body>
</html>