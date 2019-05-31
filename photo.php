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
		<h1>Edit your photo!</h1>
		
		
		<?php
			$photoId = isset($_REQUEST['photoId']) ? $_REQUEST['photoId'] : null;
			//echo $photoId;
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
<?php
		echo'<div class="buttons">';
		$explodeName = explode(".", $row['image']); //splits by .(dot)
		$extension = end($explodeName);
		//echo $extension;
			$targetJPG = str_replace($extension,'jpg',$row['image']);
			$targetPNG = str_replace($extension,'png',$row['image']);
			$targetJPEG = str_replace($extension,'jpeg',$row['image']);
			//echo $targetPNG;
			echo'<div class="dropup">';
			//echo"<a href='imagini_upload/".$row['image']."' download='".$target."'>";
			echo'<button class="dropbtn"> Download </button>';
				echo '<div class="dropup-content">';
					echo"<a href='imagini_upload/".$row['image']."' download='".$targetJPG."'>";
					echo'As JPG</a>';
					echo"<a href='imagini_upload/".$row['image']."' download='".$targetJPEG."'>";
					echo'As JPEG</a>';
					echo"<a href='imagini_upload/".$row['image']."' download='".$targetPNG."'>";
					echo'As PNG</a>';
			echo'</div></div>';
			
			?>
			
			<form method="POST">
			<input class="dropbtn" type="submit" name="delete" value="Delete">
			</form >
			
			<div class="dropup">
				<button class="dropbtn">Edit photo</button>
				<div class="dropup-content">
					<a href="#">Resize</a>
					<a href="#">Spin</a>
					<a href="#">Apply filters</a>
				</div>
			</div>
			<div class="dropup">
				<button class="dropbtn">Edit Informations</button>
				<div class="dropup-content-edit-info">
					<a class="edit-info" href="#popup1">Title</a>
					
					<form action="" method="POST">
					   <div id="popup1" class="overlay">
							<div class="popup">
							<h2>Change your title!</h2>
							<a class="close" href="#">X</a>
						<div class="content">
						<?php
						$result1 = mysqli_query($db, "SELECT image, image_text , image_title , image_tags FROM images join users on images.galleryID = users.userID where username='$usr' and images.id='$photoId' ");
						$row = mysqli_fetch_array($result1);
						$title = $row['image_title'];
						echo'<input type = "text" name="newTitle" value="'.$title.'"/>';
						?>
						<input class="dropbtn" type = "submit" value="Change" name="changeBtn">
						<?php
						if(isset($_POST['changeBtn'])) {
					if(isset($_POST['newTitle'])){
					$changeTitle = $_POST['newTitle'];
					}
					$result = mysqli_query($db, "UPDATE images set image_title='$changeTitle' Where images.id='$photoId'");
					header("location: gallery.php");
				}
						?>
						</div>
						</div>
						</div>	
						</form>	
						
					<a class="edit-info" href="#popup2">Description</a>
					
						<form action="" method="POST">
					   <div id="popup2" class="overlay">
							<div class="popup">
							<h2>Change your description!</h2>
							<a class="close" href="#">X</a>
						<div class="content">
						<?php
						$result2 = mysqli_query($db, "SELECT image, image_text , image_title , image_tags FROM images join users on images.galleryID = users.userID where username='$usr' and images.id='$photoId' ");
						$row = mysqli_fetch_array($result2);
						$text = $row['image_text'];
						echo'<input type = "text" name="newDesc" value="'.$text.'"/>';
						?>
						<input class="dropbtn" type = "submit" value="Change" name="changeBtn2">
						<?php
						if(isset($_POST['changeBtn2'])) {
					if(isset($_POST['newDesc'])){
					$changeDesc = $_POST['newDesc'];
					}
					
					$result = mysqli_query($db, "UPDATE images set image_text='$changeDesc' Where images.id='$photoId'");
					header("location: gallery.php");
				}
						?>
						</div>
						</div>
						</div>	
						</form>	
					
					<a class="edit-info" href="#popup3">Tag</a>
					
						<form action="" method="POST">
					   <div id="popup3" class="overlay">
							<div class="popup">
							<h2>Change your tag!</h2>
							<a class="close" href="#">X</a>
						<div class="content">
						<?php
						$result3 = mysqli_query($db, "SELECT image, image_text , image_title , image_tags FROM images join users on images.galleryID = users.userID where username='$usr' and images.id='$photoId' ");
						$row = mysqli_fetch_array($result3);
						$tag = $row['image_tags'];
						echo'<input type = "text" name="newTag" value="'.$tag.'"/>';
						?>
						
						<input class="dropbtn" type = "submit" value="Change" name="changeBtn3">
						<?php
						if(isset($_POST['changeBtn3'])) {
					if(isset($_POST['newTag'])){
					$changeTag = $_POST['newTag'];
					}
					
					$result = mysqli_query($db, "UPDATE images set image_tags='$changeTag' Where images.id='$photoId'");
					header("location: gallery.php");
				}
						?>
						</div>
						</div>
						</div>	
						</form>	
				</div>
			</div>
		
			<?php
				if(isset($_POST['delete'])) {
				$result = mysqli_query($db, "Delete from images where images.id='$photoId'");
				$photoId = isset($_REQUEST['photoId']) ? $_REQUEST['photoId'] : null;
			//echo $photoId;
				header("location: delete.php");
			
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