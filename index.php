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
		<div class="search">
			<p>Filter</p>
			<div class="dropbtn">
				<select class="select" style="color:white; background-color:black; width: 150px; height: 50px;border:black;">
					<option>Dog</option>
					<option>Travel</option>
					<option>Food</option>
					<option>City</option>
					<option>#love</option>
					<option>#sweet</option>
					<option>#food</option>
					<option>#dog</option>
					<option>#red</option>
					<option>#black</option>
					<option>#blue</option>
					<option>#white</option>
					<option>#samoyed</option>
					<option>#chowchow</option>
					<option>#puppy</option>
					<option>#fluffly</option>
					<option>#NewYork</option>
					<option>#vacation</option>
					<option>#surprise</option>
					<option>#pancakes</option>
					<option>#strawberries</option>
					<option>#gold</option>
				</select>
			</div>
			<input type="text" placeholder="Search...">
		</div>
		<?php
			$photoId = isset($_REQUEST['photoId']) ? $_REQUEST['photoId'] : null;
			echo $photoId;
			$usr = $_SESSION['username'];
			$result = mysqli_query($db, "SELECT image, image_text , image_title , image_tags FROM images join users on images.galleryID = users.userID where username='$usr' and images.id='$photoId'");
			$row = mysqli_fetch_array($result);
			echo"<img src='imagini_upload/".$row['image']."'class='image'>";
			echo'<p>';
				echo '<div class="desc">'.$row['image_text']."</div>";
				echo '<div class="desc">'.$row['image_title']."</div>";
				echo '<div class="desc">'.$row['image_tags']."</div>";
		echo'</p>';
		?> 

		<div>
			<img src="imagini/EmpireState.jpg" alt="state" class="image">
		</div>

		<p>Orașul New York este cel mai populat oraș din Statele Unite ale Americii, zona sa metropolitană fiind una
			dintre cele mai mari zone urbane din lume.</p>
		<div class="buttons">
			<button class="dropbtn"> Download </button>
			<input class="dropbtn" type="button" name="delete" value="Delete">
			<div class="dropup">
				<button class="dropbtn">Edit photo</button>
				<div class="dropup-content">
					<a href="#">Resize</a>
					<a href="#">Spin</a>
					<a href="#">Apply filters</a>
				</div>
			</div>
			<button class="dropbtn"> Upload </button>
			<div class="dropup">
				<button onclick="myFunction()" class="dropbtn">Edit Informations</button>
				<div class="dropup-content">
					<a href="#">Title</a>
					<a href="#">Description</a>
					<a href="#">Tag</a>
				</div>
			</div> <button class="dropbtn"> Format1 </button>
			<button class="dropbtn"> Format2 </button>
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