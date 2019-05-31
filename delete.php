<?php 
  include('server.php'); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" href="imagini/logo.jpg">
	<title>PiX</title>
</head>

<body>

	<header>

		<div class="space">
			<div class="band">

			</div>
		</div>

		<ul class="clearfix">
		    
			
			<?php  if (isset($_SESSION['username'])) : ?>
    	        <li> <a href="index.php?logout='1'" >Logout</a> </li>
			<?php endif ?>
			<li><a href="upload.php"> Upload</a><br></li>
			<li><a href="index.php"> Home</a><br></li>
			<li><a href="gallery.php"> Gallery</a><br></li>
		</ul>
		

	</header>
	<article>
		<h3>Your photo was deleted!</h3>
		
		<div>
			<img src="imagini/delete.jpg" alt="state" class="image">
		</div>

		
	</article>
	<footer>
		<nav>
			<ul class="footer">
				<li>
					© 2019 PiX
				</li>
				<li>
					<a href="about.html">About</a>
				</li>
				<li>
					<a href="help-center.html">Help Center</a>
				</li>
				<li>
					<a href="cookies.html">Cookies</a>
				</li>
				<li>
					<a href="settings.html">Settings</a>
				</li>

			</ul>
		</nav>
	</footer>
</body>

</html>