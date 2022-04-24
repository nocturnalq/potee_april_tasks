<header class="headerOther">
			<div>
				<a href="/portal" class="logo logoOther">
    			<svg class="logo-icon" xmlns="http://www.w3.org/2000/svg"
		         xmlns:xlink="http://www.w3.org/1999/xlink"
		         width="64" height="56">
      			<path d="M52.873,55.128 L58.125,45.939 L63.377,55.128 L52.873,55.128 ZM46.303,45.172 L56.811,45.172 L51.557,54.359 L46.303,45.172 ZM51.557,34.451 L56.811,43.641 L46.303,43.641 L51.557,34.451 ZM39.738,33.686 L50.243,33.686 L44.990,42.874 L39.738,33.686 ZM44.990,22.967 L50.243,32.154 L39.738,32.154 L44.990,22.967 ZM33.168,22.202 L43.676,22.202 L38.422,31.390 L33.168,22.202 ZM38.422,11.480 L43.676,20.671 L33.168,20.671 L38.422,11.480 ZM26.600,10.713 L37.108,10.713 L31.854,19.905 L26.600,10.713 ZM31.854,-0.006 L37.108,9.184 L26.600,9.184 L31.854,-0.006 ZM20.032,20.671 L25.286,11.480 L30.540,20.671 L20.032,20.671 ZM13.465,32.154 L18.718,22.967 L23.971,32.154 L13.465,32.154 ZM6.897,43.641 L12.151,34.451 L17.404,43.641 L6.897,43.641 ZM0.331,55.128 L5.582,45.939 L10.836,55.128 L0.331,55.128 ZM17.404,45.172 L12.151,54.359 L6.897,45.172 L17.404,45.172 ZM23.971,33.686 L18.718,42.874 L13.465,33.686 L23.971,33.686 ZM30.540,22.202 L25.286,31.390 L20.032,22.202 L30.540,22.202 ZM37.108,55.128 L26.600,55.128 L31.854,45.939 L37.108,55.128 ZM43.676,45.172 L38.422,54.359 L33.168,45.172 L43.676,45.172 ZM50.243,55.128 L39.738,55.128 L44.990,45.939 L50.243,55.128 Z"/>
			    </svg>
			    <span class="logo-txt">Portal</span>
  				</a>
  				<div class="hamburger-menu">
	  				<input type="checkbox" id="checkbox1" class="checkbox1 visuallyHidden">
			        <label for="checkbox1">
			            <div class="hamburger hamburger1">
			                <span class="bar bar1"></span>
			                <span class="bar bar2"></span>
			                <span class="bar bar3"></span>
			                <span class="bar bar4"></span>
			            </div>
			        </label>
		    	</div>
		  	</div>
		  	<nav>
		  		<ul class="menuOther">
		  			<li class="menu-link"> <a href="/portal/">Home </a></li>
		  			<li class="menu-link"> <a href="/portal/about/">About Us </a></li>
		  			<li class="menu-link"> <a href="/portal/portfolio">Portfolio </a></li>
		  			<li class="menu-link"> <a href="/portal/posts/">Posts </a></li>
		  			<li class="menu-link"> <a href="/portal/employees/">Employees </a></li>
		  			<li class="menu-link"> <a href="/portal/profile?id=<?php echo($_SESSION['account'])?>">Profile </a></li>
		  		</ul>
		  	</nav>
		  	<div class="account-other">
		  		<?php
		  			$id = $_SESSION['account'];
		  			$result = mysqli_query($mysql, "SELECT * FROM `users_info` WHERE `id` = '$id'");
					$user = mysqli_fetch_assoc($result);
					echo("<a href='/portal/profile?id=".$_SESSION['account']."'> <h3>".$user['login']."</h3></a> | <a class='logout' href='/portal/deauth.php'><h3>logout</h3></a>");
				?>
		  	</div>
		</header>