<?php
	session_start();
	header('Location: /portal/portfolio');
	if(move_uploaded_file($_FILES['filename']['tmp_name'], 'upload/'.$_FILES['filename']['name'])){
		echo "файл загружен";
		#$_SESSION['avatar'] = $_FILES['filename']['name'];
	} else{
		echo "ERROR!";
	}
?>
