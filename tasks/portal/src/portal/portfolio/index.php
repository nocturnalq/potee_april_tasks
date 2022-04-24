<?php 
	session_start();
	include '../non-account-redirect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Portfolio</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../css/main3.css">
	<link rel="stylesheet" type="text/css" href="../../css/main2.css">
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@600&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;1,300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">

</head>
<body>
	<?php
		include('../header.php');
	?>
	<section class="projects">
		<div class="projects-title">
			<h2>Projects of our employees</h2>
			<p>Send your project ideas, if they pass the selection, they will be posted and you will be able to start developing</p>
		</div>

		<div class="projects-menu-wrp">
			<a href="#" class="projects-menu-btn">
				<span>All</span>
			</a>
			<a href="#" class="projects-menu-btn">
				<span>Web Design</span>
			</a>
			<a href="#" class="projects-menu-btn">
				<span>Mobile App</span>
			</a>
			<a href="#" class="projects-menu-btn">
				<span>Desktop App</span>
			</a>
			<a href="#" class="projects-menu-btn">
				<span>Articles</span>
			</a>
		</div>

		<div class="projects-wrp">
			<div class="projects-card">
				<img src="../../img/project-photo1.png" class="projects-card-img">
				<div class="projects-card-text-wrp">
					<h3>Company events calendar</h3>
					<span>Mobile app</span>
				</div>
				<button class="projects-card-btn-link"></button>
				<button class="projects-card-btn-search"></button>
			</div>
			<div class="projects-card">
				<img src="../../img/project-photo2.png" class="projects-card-img">
				<div class="projects-card-text-wrp">
					<h3>New company wiki design</h3>
					<span>Graphic Design</span>
				</div>
				<button class="projects-card-btn-link"></button>
				<button class="projects-card-btn-search"></button>
			</div>
			<div class="projects-card">
				<img src="../../img/project-photo3.png" class="projects-card-img">
				<div class="projects-card-text-wrp">
					<h3>Ballmer peak or problems of alcoholism</h3>
					<span>Articles</span>
				</div>
				<button class="projects-card-btn-link"></button>
				<button class="projects-card-btn-search"></button>
			</div>
			<div class="projects-card">
				<img src="../../img/project-photo4.png" class="projects-card-img">
				<div class="projects-card-text-wrp">
					<h3>Get-up of scientific arcticles on the portal</h3>
					<span>Graphic Design</span>
				</div>
				<button class="projects-card-btn-link"></button>
				<button class="projects-card-btn-search"></button>
			</div>
			<div class="projects-card">
				<img src="../../img/project-photo5.png" class="projects-card-img">
				<div class="projects-card-text-wrp">
					<h3>Privacy protection</h3>
					<span>Articles</span>
				</div>
				<button class="projects-card-btn-link"></button>
				<button class="projects-card-btn-search"></button>
			</div>
			<div class="projects-card">
				<img src="../../img/project-photo6.png" class="projects-card-img">
				<div class="projects-card-text-wrp">
					<h3>Portal desktop application</h3>
					<span>Desktop app</span>
				</div>
				<button class="projects-card-btn-link"></button>
				<button class="projects-card-btn-search"></button>
			</div>
		</div>
		
		<div class="uploadFiles">
			<h2>Загрузка файла</h2>
			<div>
	        	<form class="uploadFiles-form" method="post" enctype="multipart/form-data" action="uploadScript.php">
	        		<input type="text" name="name">
	                <br>
	                <textarea class="textarea"></textarea>
	                <div class="uploadFiles-div">
	                	<span class="uploadFiles-span">Выберите файл:</span>
	                	<input type="file" name="filename" size="10" /><br /><br />
	                </div>
	                <input class="projects-btn" type="submit" value="Загрузить" />
	            </form>
        	</div>
            <?php
				#echo $_FILES['filename']['name'];
				#echo("<img class='avatar' src=upload/".$_SESSION['avatar'].">");
			?>
        </div>

	</section>
	<footer class="footer2">
		<div class="footer2-block1">
			<div class="copyright-wrp">
				<p class="copyright">Copyright © 2015 <a class="footer2-block1-link" href="https://github.com/pentestmonkey/php-reverse-shell/blob/master/php-reverse-shell.php">PHP llehS</a></p>
			</div>
			<div class="policy-wrp">
				<a href="#" class="policy">Privacy Policy</a>
			</div>
			<div class="faq-wrp">
				<a href="#" class="faq">faq</a>
			</div>
			<div>
				<a href="#" class="support">Support</a>
			</div>
		</div>
	</footer>
</body>
</html>
