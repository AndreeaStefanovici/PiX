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
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="imagini/logo.jpg">
	<title>PiX</title>
</head>

<body>

	<header>

		<div class="space"></div>

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
		<h1>Edit your photo!</h1>
		
		
		<?php
		
			//afisare imagine preluata din galerie
		
			$photoId = isset($_REQUEST['photoId']) ? $_REQUEST['photoId'] : null;
			$photoPath = isset($_REQUEST['photoPath']) ? $_REQUEST['photoPath'] : null;
			
			if($photoId!=null) {
				$usr = $_SESSION['username'];
				$result = mysqli_query($db, "SELECT image, image_text , image_title , image_tags FROM images join users on images.galleryID = users.userID where username='$usr' and images.id='$photoId'");
				$row = mysqli_fetch_array($result);
				echo"<img src='imagini_upload/".$row['image']."'class='image'>";
				echo'<p>';
				echo '<div class="desc">'.$row['image_text']."</div>";
				echo '<div class="desc">'.$row['image_title']."</div>";
				echo '<div class="desc">'.$row['image_tags']."</div>";
				echo'</p>';
			}
			else
			{
				echo"<img src='imagini_upload/".$photoPath."'class='image'>";
			}
		?>
		

<?php

    //buton download
	
		if ($photoId != null){
				echo'<div class="buttons">';
				$explodeName = explode(".", $row['image']); //splits by .(dot)
				$extension = end($explodeName);
		
				$targetJPG = str_replace($extension,'jpg',$row['image']);
				$targetPNG = str_replace($extension,'png',$row['image']);
				$targetJPEG = str_replace($extension,'jpeg',$row['image']);
			
					echo'<div class="dropup">';
					echo'<button class="dropbtn"> Download </button>';
					echo '<div class="dropup-content">';
					echo"<a href='imagini_upload/".$row['image']."' download='".$targetJPG."'>";
					echo'As JPG</a>';
					echo"<a href='imagini_upload/".$row['image']."' download='".$targetJPEG."'>";
					echo'As JPEG</a>';
					echo"<a href='imagini_upload/".$row['image']."' download='".$targetPNG."'>";
					echo'As PNG</a>';
					echo'</div></div>';
		}
		

		else{
				echo'<div class="buttons">';
					$explodeName = explode(".", $photoPath); //splits by .(dot)
					$extension = end($explodeName);
					$targetJPG = str_replace($extension,'jpg',$photoPath);
					$targetPNG = str_replace($extension,'png',$photoPath);
					$targetJPEG = str_replace($extension,'jpeg',$photoPath);
				echo'<div class="dropup">';
				echo'<button class="dropbtn"> Download </button>';
				echo '<div class="dropup-content">';
				echo"<a href='imagini_upload/".$photoPath."' download='".$targetJPG."'>";
				echo'As JPG</a>';
				echo"<a href='imagini_upload/".$photoPath."' download='".$targetJPEG."'>";
				echo'As JPEG</a>';
				echo"<a href='imagini_upload/".$photoPath."' download='".$targetPNG."'>";
				echo'As PNG</a>';
				echo'</div></div>';
		
		}
			?>
		
			<?php
					
					//poza poate fi stearsa doar inainte de editare 
					
					if($photoId!=null){
							echo'<form method="POST">';
							echo'<input class="dropbtn" type="submit" name="delete" value="Delete">';
							echo'</form >';
					}
			
					//stergere poza
			
					if(isset($_POST['delete'])) {
							$result = mysqli_query($db, "Delete from images where images.id='$photoId'");
							$photoId = isset($_REQUEST['photoId']) ? $_REQUEST['photoId'] : null;
							header("location: delete.php");
					}
				
			?>
		
			<div class="dropup">
			<form method="POST">
				<button type = "button" class="dropbtn">Edit photo</button>
				<div class="dropup-content-edit-info">
					
					
					
		<?php			
				//incercare buton resize
				
				/*	
					<a class="edit-info" href="#popup10">Resize</a>					
					<form action="" method="POST">
					   <div id="popup10" class="overlay">
							<div class="popup">
							<h2>Resize your photo!</h2>
							<p> Your photo will be downloaded with the new dimensions. </p>
							<a class="close" href="#">X</a>
						<div class="content">
						
						
			
						//RESIZE
						
						$result1 = mysqli_query($db, "SELECT image_width , image_height FROM images join users on images.galleryID = users.userID where username='$usr' and images.id='$photoId' ");
						$row = mysqli_fetch_array($result1);
						$w = $row['image_width'];
						$h = $row['image_height'];
						
						echo'<input type = "number" name="newWidth" value="'.$w.'"/>';
						echo'<input type = "number" name="newHeight" value="'.$h.'"/>';
						echo '	<input class="dropbtn" type = "submit" value="Resize" name="changeDim">';
						
						if(isset($_POST['changeDim'])) {
								if(isset($_POST['newWidth']) && isset($_POST['newHeight'])){
									$changeWidth = $_POST['newWidth'];
									$changeHeight = $_POST['newHeight'];
								}
					
					        $type= exif_imagetype('imagini_upload/6'.$filename);
				            switch ($type) {
								case 1 : $img = imageCreateFromGif ( 'imagini_upload/'.$filename);break;
								case 2 : $img = imageCreateFromJpeg( 'imagini_upload/'.$filename);break;
								case 3 : $img = imageCreateFromPng ( 'imagini_upload/'.$filename );break;
							}
					
							//$img = imagecreatefrompng('imagini_upload/'.$filename);
					
							$path = 'imagini_upload/'.$filename;
							//$resize=imagescale($img,  $changeWidth  , $changeHeight, IMG_BICUBIC_FIXED);
							IMAGEPNG($resize , $path);
					
					
							imagedestroy($img);
							imagedestroy($resize);
				
						}
				
						
						</div>
						</div>
						</div>	
						</form> //sfarsit resize */
			?>
					
						
					<input class="edit-infoo" type = "submit" value="Flip" name="flipH">
					<input class="edit-infoo" type = "submit" value="Filter Gray" name="filterGray">
					<input class="edit-infoo" type = "submit" value="Filter Emboss" name="filterEmboss">
					<input class="edit-infoo" type = "submit" value="Filter Brightness" name="filterBrightness">
				</div>
			</form>
			</div>
			
			
			<?php
			
	
			$usr = $_SESSION['username'];
			$result = mysqli_query($db, "SELECT image FROM images join users on images.galleryID = users.userID where username='$usr' and images.id='$photoId'");
			$row = mysqli_fetch_array($result);
			$filename = $row['image'];
			if($row==null)
			{
				$filename = isset($_REQUEST['photoPath']) ? $_REQUEST['photoPath'] : null;
			}
					

			// filtru GrayScale		
				
				if(isset($_POST['filterGray'])){
					
					
				   $type= exif_imagetype('imagini_upload/'.$filename);
				   switch ($type) {
						case 1 : $img = imageCreateFromGif ( 'imagini_upload/'.$filename);break;
						case 2 : $img = imageCreateFromJpeg( 'imagini_upload/'.$filename);break;
						case 3 : $img = imageCreateFromPng ( 'imagini_upload/'.$filename );break;
				   }
					
					//$img = imagecreatefrompng('imagini_upload/'.$filename);
					
					$path = 'imagini_upload/1'.$filename;
					if($img && imagefilter($img, IMG_FILTER_GRAYSCALE))
					{ IMAGEPNG($img , $path);
					}
					
					imagedestroy($img);
					
					
					header("location: photo.php?photoPath=1".$filename);
					
					
					
				}

	// filtru Emboss
			
				if(isset($_POST['filterEmboss'])){
					
					
				   $type= exif_imagetype('imagini_upload/'.$filename);
				   switch ($type) {
						case 1 : $img = imageCreateFromGif ( 'imagini_upload/'.$filename);break;
						case 2 : $img = imageCreateFromJpeg( 'imagini_upload/'.$filename);break;
						case 3 : $img = imageCreateFromPng ( 'imagini_upload/'.$filename );break;
				   }
					
					//$img = imagecreatefrompng('imagini_upload/'.$filename);
					
					$path = 'imagini_upload/2'.$filename;
					if($img && imagefilter($img, IMG_FILTER_EMBOSS))
					{ IMAGEPNG($img , $path);
					}
					
					imagedestroy($img);
					
					
					header("location: photo.php?photoPath=2".$filename);
					
					
					
				}	
				
				
	// filtru Brightness
			
				if(isset($_POST['filterBrightness'])){
					
					
				   $type= exif_imagetype('imagini_upload/'.$filename);
				   switch ($type) {
						case 1 : $img = imageCreateFromGif ( 'imagini_upload/'.$filename);break;
						case 2 : $img = imageCreateFromJpeg( 'imagini_upload/'.$filename);break;
						case 3 : $img = imageCreateFromPng ( 'imagini_upload/'.$filename );break;
				   }
					
					//$img = imagecreatefrompng('imagini_upload/'.$filename);
					
					$path = 'imagini_upload/3'.$filename;
					if($img && imagefilter($img, IMG_FILTER_BRIGHTNESS, 50))
					{ IMAGEPNG($img , $path);
					}
					
					imagedestroy($img);
					
					
					header("location: photo.php?photoPath=3".$filename);
					
					
					
				}	

// FLIPPPPP
			
				if(isset($_POST['flipH'])){
					
					
				   $type= exif_imagetype('imagini_upload/'.$filename);
				   switch ($type) {
						case 1 : $img = imageCreateFromGif ( 'imagini_upload/'.$filename);break;
						case 2 : $img = imageCreateFromJpeg( 'imagini_upload/'.$filename);break;
						case 3 : $img = imageCreateFromPng ( 'imagini_upload/'.$filename );break;
				   }
					
					//$img = imagecreatefrompng('imagini_upload/'.$filename);
					
					$path = 'imagini_upload/4'.$filename;
					if($img && imageflip($img, IMG_FLIP_HORIZONTAL))
					{ IMAGEPNG($img , $path);
					}
					
					imagedestroy($img);
					
					
					header("location: photo.php?photoPath=4".$filename);
					
					
					
				}
				

			
			?>
			
			
			
			
			
		<?php
			
			//edit informatii pt titlu,tag-uri,descriere 
			//apare doar inainte de editarea pozei
			
			if ( $photoId != null )
			{
			
			echo '<div class="dropup">
				<button class="dropbtn">Edit Informations</button>
				<div class="dropup-content-edit-info">
					<a class="edit-info" href="#popup1">Title</a>
					
					<form action="" method="POST">
					   <div id="popup1" class="overlay">
							<div class="popup">
								<h2>Change your title!</h2>
								<a class="close" href="#">X</a>
								<div class="content">';
						
						
						
						//editare informatii titlu
						
							$result1 = mysqli_query($db, "SELECT image, image_text , image_title , image_tags FROM images join users on images.galleryID = users.userID where username='$usr' and images.id='$photoId' ");
							$row = mysqli_fetch_array($result1);
							$title = $row['image_title'];
						echo'<input type = "text" name="newTitle" value="'.$title.'"/>';
						echo '	<input class="dropbtn" type = "submit" value="Change" name="changeBtn">';
						
							if(isset($_POST['changeBtn'])) {
								if(isset($_POST['newTitle'])){
											$changeTitle = $_POST['newTitle'];
									}
								$result = mysqli_query($db, "UPDATE images set image_title='$changeTitle' Where images.id='$photoId'");
								header("location: gallery.php");
							}
						
						echo '
						</div></div></div></form>	
						
						
						
						<a class="edit-info" href="#popup2">Description</a>
					
						<form action="" method="POST">
							<div id="popup2" class="overlay">
								<div class="popup">
									<h2>Change your description!</h2>
									<a class="close" href="#">X</a>
									<div class="content">';
						
						
						//editare informatii descriere
						
						$result2 = mysqli_query($db, "SELECT image, image_text , image_title , image_tags FROM images join users on images.galleryID = users.userID where username='$usr' and images.id='$photoId' ");
						$row = mysqli_fetch_array($result2);
						$text = $row['image_text'];
						
						
						
						echo'<input type = "text" name="newDesc" value="'.$text.'"/>
							<input class="dropbtn" type = "submit" value="Change" name="changeBtn2">';
					
					
						if(isset($_POST['changeBtn2'])) {
							if(isset($_POST['newDesc'])){
									$changeDesc = $_POST['newDesc'];
								}
							$result = mysqli_query($db, "UPDATE images set image_text='$changeDesc' Where images.id='$photoId'");
							header("location: gallery.php");
						}
						
						
						echo'</div></div></div>	</form>	
						
						
					
					<a class="edit-info" href="#popup3">Tag</a>
					
						<form action="" method="POST">
							<div id="popup3" class="overlay">
								<div class="popup">
									<h2>Change your tag!</h2>
									<a class="close" href="#">X</a>
									<div class="content">';
						
						
						
						//editare informatii tag-uri
						
						$result3 = mysqli_query($db, "SELECT image, image_text , image_title , image_tags FROM images join users on images.galleryID = users.userID where username='$usr' and images.id='$photoId' ");
						$row = mysqli_fetch_array($result3);
						$tag = $row['image_tags']; 
						
						
						echo'<input type = "text" name="newTag" value="'.$tag.'"/>
								<input class="dropbtn" type = "submit" value="Change" name="changeBtn3">';
						
												
						if(isset($_POST['changeBtn3'])) {
							if(isset($_POST['newTag'])){
								$changeTag = $_POST['newTag'];
								}					
							$result = mysqli_query($db, "UPDATE images set image_tags='$changeTag' Where images.id='$photoId'");
							header("location: gallery.php");
						}
						
						
						echo'</div></div></div>	</form>	
				</div>
			</div>';
		
		
		
		//sfarsit edit informatii
			}
			?>
		

		


	
	
	</article>
	
	
	<footer>
		<nav>
			<ul class="footer">
				<li>
					© 2019 PiX
				</li>
				<li>
					<a href="index.php">Home</a>
				</li>
				<li>
					<a href="gallery.php">Gallery</a>
				</li>
				<li>
					<a href="upload.php">Upload</a>
				</li>
				

			</ul>
		</nav>
	</footer>
</body>

</html>