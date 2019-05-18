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
	<link rel="stylesheet" type="text/css" href="gallery.css">
	<link rel="icon" href="imagini/logo.jpg">
	<title>PiX</title>
</head>

<body>

	<header>

		<div class="space">
			<div class="band">

			</div>
		</div>

		<ul class="clearfix"> ';
		    
			  if (isset($_SESSION['username'])): 
    	        echo'<li> <a href="index.php?logout=1" >Logout</a> </li> ';
				endif;
			echo'
			<li><a href="upload.php"> Upload</a><br></li>
			<li><a href="index.php"> Home</a><br></li>
			<li><a href="gallery.php"> Gallery</a><br></li>
		</ul>
		</header>';
				echo "<p>".$_SESSION['username']."</p>";
				$usr = $_SESSION['username'];
				$result = mysqli_query($db, "SELECT image, image_text , image_title , image_tags FROM images join users on images.galleryID = users.userID where username='$usr'");
				while ($row = mysqli_fetch_array($result)) {
				
				      
	
	
		echo ' <div class="gallery">';
				$image = $row['image'];
				$request_id = mysqli_query($db, "SELECT id from images where image='$image'");
				$id=mysqli_fetch_array($request_id);
				$id = $id['id'];
				echo $id;
				echo'<a target="_blank"'; echo"href='index.php?photoId=".$id."'>";
				echo"<img src='imagini_upload/".$row['image']."' "; echo'width="600" height="400">';
				echo "</a>";
			echo'<div >';
				echo '<div class="desc">'.$row['image_text']."</div>";
				echo '<div class="desc">'.$row['image_title']."</div>";
				echo '<div class="desc">'.$row['image_tags']."</div>";
		echo'</div></div>';
}
	
echo'</body>

</html>	';
}
?>