<?php
  // Create database connection
  include('server.php');
  if(isset($_SESSION['username']))
{
  echo '
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="css/gallery.css">
	<link rel="icon" href="imagini/logo.jpg">
	<title>PiX</title>
</head>

<body>

	<header>

		<div class="space"></div>

		<ul class="clearfix"> ';
		    
			  if (isset($_SESSION['username'])): 
    	        echo'<li> <a href="index.php?logout=1" >Logout</a> </li> ';
				endif;
			echo'
			<li><a href="upload.php"> Upload</a><br></li>
			<li><a href="index.php"> Home</a><br></li>
			<li><a href="gallery.php"> Gallery</a><br></li>
		</ul>
		</header>
		
		<form action="search.php" method="POST">
		<div class="search">
			<div class="dropdown">
				<select name="filter" class="dropbtn">
					<option value="title">Title</option>
					<option value="tag">Tag</option>
					<option value="sizeBigger">Size Bigger Than</option>
					<option value="sizeSmaller">Size Smaller Than</option>
					<option value="width">Width</option>
					<option value="height">Height</option>
					<option value="dimensions">Dimensions</option>
				</select>
			</div>
			<input class = "cauta" type="text" placeholder="Search..." name="search">
			<input class="dropbtn" type = "submit" value="Search" name="searchBtn">
		</div>
		</form>
		
		<div id="photo-gallery">';
		
		//afisare imagini (titlu.tag-uri) in gallery dupa upload
				
				$usr = $_SESSION['username'];
				$result = mysqli_query($db, "SELECT image, image_width, image_height , image_title , image_tags FROM images join users on images.galleryID = users.userID where username='$usr'");
				
				while ($row = mysqli_fetch_array($result)) {
					
		echo ' <div class="gallery">';
		
					$image = $row['image'];
					$request_id = mysqli_query($db, "SELECT id from images where image='$image'");
					$id=mysqli_fetch_array($request_id);
					$id = $id['id'];
					
		echo'<a '; echo"href='photo.php?photoId=".$id."'>";
		echo"<img src='imagini_upload/".$row['image']."'</a><div >";
		echo '<div class="desc">'.$row['image_title']."</div>";
		echo '<div class="desc">'.$row['image_tags']."</div>";
		echo '<div class="desc">'.$row['image_width'].'x'.$row['image_height'].'</div>';
		echo'</div></div>';
		
				}
				
		echo '</div></body>
</html>	';
}
?>
