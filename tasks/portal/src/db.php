<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$mysql = new mysqli(getenv("DB_URL"), getenv("DB_USER"), getenv("DB_PASSWORD"), 'users');

	if (mysqli_connect_errno()) {
		echo mysqli_connect_errno();
		echo mysqli_connect_error();
	}
?>
