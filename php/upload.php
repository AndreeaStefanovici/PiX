<?php
include('server.php');

if(isset($_SESSION['username']))
{


  // Initialize message variable
  $msg = "";
  //apasare buton click
  if (isset($_POST['upload'])) {
	
	$allowed =  array('jpeg','png' ,'jpg');
	$filename = $_FILES['image']['name'][0];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	if(!in_array($ext, $allowed) ) {
		array_push($errors, "File extension is not allowed!");
		//echo"NUUUUU";
	}
	else{
	$imagesCount = count($_FILES['image']['name']);
  	
  	//preluare titlu , descriere, tag
  	$image_text = mysqli_real_escape_string($db, $_POST['image_text']);
    $image_title = mysqli_real_escape_string($db, $_POST['image_title']);
	$image_tags = mysqli_real_escape_string($db, $_POST['image_tags']);
	$usr = $_SESSION['username'];
	$resultt = mysqli_query($db, "SELECT userID from users where username = '$usr'");
	$galleryID = mysqli_fetch_array($resultt);
	$galleryID = $galleryID['userID'];
	//echo $galleryID['userID'];
  	
	
	for($i = 0; $i < $imagesCount; $i++){ 
	  	// nume imagine
		$image = $_FILES['image']['name'][$i];
		// fisierul imaginilor
		$target = "imagini_upload/".basename($image);

		//image size, dimensions
		$width = getimagesize($_FILES['image']['tmp_name'][$i])[0];
		$height = getimagesize($_FILES['image']['tmp_name'][$i])[1];
		$size = round(filesize($_FILES['image']['tmp_name'][$i])/1024, 1);
				
		$sql = "INSERT INTO images (image, image_text , image_title, image_tags, galleryID, image_size, image_width, image_height) VALUES ('$image', '$image_text', '$image_title', '$image_tags', '$galleryID', '$size', '$width', '$height')";
		// upload success/fail
		mysqli_query($db, $sql);
		
	
		if (move_uploaded_file($_FILES['image']['tmp_name'][$i], $target)) {
			$msg = "Image uploaded successfully";
		}else{
			$msg = "Failed to upload image";
		}
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
	<link rel="stylesheet" type="text/css" href="css/upload.css">
	<link rel="icon" href="imagini/logo.jpg">
	<title>PiX</title>
	
</head>

<body>
   <header>
	//spatiul de deasupra meniului
		<div class="space"></div>
		
        <div class="menu">
		<ul class="clearfix">
		    
			<li><a href="login.php"> LogOut</a><br></li>
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
			     <input  type="hidden" name="size" value="1000000">
						
						<label class="label_upload">
						<input type="file" name="image[]" multiple />
                         Choose File </label>
					
			     <div>			
				 <br>
				 <label for="descriere"> Description:</label>
				 <textarea rows="4" id="descriere" name="image_text" placeholder="Say something about this image..."></textarea>
				 <label for="titlu"> Title:</label>
				 <textarea rows="1" cols="50" id="titlu" name="image_title" placeholder="Add title..."></textarea>
				 <label for="tags"> Tags:</label>
				 <textarea rows="2" cols="50" id="tags" name="image_tags" placeholder="Add tags..."></textarea>
				 <br>
				 </div>';
				 //erori 
				  include('errors.php');
				 echo'<div>
				 <button class = "dropbtn" name="upload">Submit</button>
				 </div>
			  </form>
		</div>

	</div>	
	
</body>

</html>';
}
?>

