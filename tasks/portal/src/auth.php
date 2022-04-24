<?php
	session_start();
	include 'db.php';

	$login = $_POST['login'];
	$passwd = $_POST['passwd'];
	$card = $_POST['card'];
	$token = $_POST['token'];
	$action = $_POST['action'];

	if($action == "signin") {
		$result = mysqli_query($mysql, "SELECT * FROM `users_info` WHERE `login` = '$login' AND `password` = '$passwd'");
		$user = mysqli_fetch_assoc($result);
		if ($user == null) {
			$_SESSION['msgError'] = "invalid logpass";
			header('Location: /');
		}else{
			$_SESSION['msgError'] = "";
			$_SESSION['account'] = $user['id'];
			header('Location: /portal');
		}
	}elseif ($action == "signup") {
		if (!(trim($login) && trim($passwd) && trim($card))) {
			$_SESSION['msgError'] = "all fields must be filled";
			header('Location: /');
		}else{
			$result = mysqli_query($mysql, "SELECT * FROM `users_info` WHERE `login` = '$login'");
			$user = mysqli_fetch_assoc($result);

			if ($token == "hu9gh49h249uhfu293HFYUEFebfyug328fg238fhu32d193uhd238udh23u9fh9248fj4f") {
				if ($user == null) {
					$register = mysqli_query($mysql, "INSERT INTO `users_info` (`login`, `password`, `card`) VALUES ('$login', '$passwd', '$card')");
					$_SESSION['msgError'] = "";
					header('Location: /');
				}else{
					$_SESSION['msgError'] = "User with this login already exist"; 
					header('Location: /');
				}
			}else{
				$_SESSION['msgError'] = "invalid authentication token. Contact your administrator to get it";
				header('Location: /');
			}
		}
	}
?>