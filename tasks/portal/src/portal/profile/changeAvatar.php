<?php
	session_start();
	include '../non-account-redirect.php';
	header('Location: /portal/profile?id='.$user['id'].'');
	$id = $_GET['id'];
	$_FILES['filename']['name'] = $id.'.png';

	if(move_uploaded_file($_FILES['filename']['tmp_name'], 'avatars/'.$_FILES['filename']['name'])){
	} else{
		echo "ERROR!";
	}
?>