<?php
include('server.php');

if(isset($_SESSION['username']))
{

// Create database connection
  //$db = mysqli_connect("localhost", "root", "", "image_upload");

  // Initialize message variable
  $msg = "";
  // If upload button is clicked ...
  if (isset($_POST['upload'])) {

	$imagesCount = count($_FILES['image']['name']);
  	
  	// Get text
  	$image_text = mysqli_real_escape_string($db, $_POST['image_text']);
    $image_title = mysqli_real_escape_string($db, $_POST['image_title']);
	$image_tags = mysqli_real_escape_string($db, $_POST['image_tags']);
	$usr = $_SESSION['username'];
	$resultt = mysqli_query($db, "SELECT userID from users where username = '$usr'");
	$galleryID = mysqli_fetch_array($resultt);
	$galleryID = $galleryID['userID'];
	//echo $galleryID['userID'];
  	
	
	for($i = 0; $i < $imagesCount; $i++){ 
	  	// Get image name
		$image = $_FILES['image']['name'][$i];
		// image file directory
		$target = "imagini_upload/".basename($image);
	
		$sql = "INSERT INTO images (image, image_text , image_title, image_tags, galleryID) VALUES ('$image', '$image_text', '$image_title', '$image_tags', '$galleryID')";
		// execute query
		mysqli_query($db, $sql);
	
		if (move_uploaded_file($_FILES['image']['tmp_name'][$i], $target)) {
			$msg = "Image uploaded successfully";
		}else{
			$msg = "Failed to upload image";
		}
	}
	
  }
echo '
  
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="upload.css">
	<link rel="icon" href="imagini/logo.jpg">
	<title>PiX</title>
	<style type="text/css">
   #content{
   	width: 50%;
   	margin: 20px auto;
   	border: 1px solid #cbcbcb;
   }
   form{
   	width: 50%;
   	margin: 20px auto;
   }
   form div{
   	margin-top: 5px;
   }
   #img_div{
   	width: 80%;
   	padding: 5px;
   	margin: 15px auto;
   	border: 1px solid #cbcbcb;
   }
   #img_div:after{
   	content: "";
   	display: block;
   	clear: both;
   }
   img{
   	float: left;
   	margin: 5px;
   	width: 300px;
   	height: 140px;
   }
</style>
</head>

<body>
   <header>

		<div class="space">
			<div class="band">

			</div>
		</div>
		
        <div class="menu">
		<ul class="clearfix">
		    
			<li><a href="login.html"> LogOut</a><br></li>
			<li> Upload<br></li>
			<li><a href="index.php"> Home</a><br></li>
			<li><a href="gallery.php"> Gallery</a><br></li>
		</ul>
        </div>
	</header>
	
	
	<div class = "body_wrapper">
	   <div class = "little_icon_container">
            <div class = "little_icon">
                <img class = "icon" src="imagini/upload.png" alt="logo">
            </div>
        </div>
		
		<p> Select a file to upload :</p>
		
		<div class = "formUpload">
	
		   
  
		      <form  method="POST" action="upload.php" enctype="multipart/form-data"> 
			     <input type="hidden" name="size" value="1000000">
						<div>
						<input  type="file" name="image[]" multiple />
                      
						</div>
			     <div>			
				 <br>
				 <p> Description:</p>
				 <textarea rows="4" cols="50" id="box" name="image_text" placeholder="Say something about this image..."></textarea>
				 <p> Title:</p>
				 <textarea rows="1" cols="50" id="box" name="image_title" placeholder="Add title..."></textarea>
				 <p> Tags:</p>
				 <textarea rows="2" cols="50" id="box" name="image_tags" placeholder="Add tags..."></textarea>
				 <br>
				 </div>
				 <div>
				 <button class = "dropbtn" name="upload">Submit</button>
				 </div>
			  </form>
		</div>

	</div>	
	
</body>

</html>';
}
?>

