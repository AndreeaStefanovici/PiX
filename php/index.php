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
	<link rel="stylesheet" type="text/css" href="css/index.css">
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
		<h1>Welcome!</h1>
		<p>Let's create amazing photos and designs together!</p>
		
		<div id="image-home">
			
		</div>
		
		 <script>
        let body = document.querySelector('#image-home');
        fetch('https://pixabay.com/api/?key=12701106-5c85c70da5955cf5973e2c5b7&image_type=photo&pretty=true&category=photography&id=1080016') // returneaza un promise
            .then((resp) => {
                return resp.json();
                //console.log('Succes!');
            })
            .then((jsonResp) => {
                //console.log(jsonResp)
                let img = document.createElement('img');
                img.setAttribute("src", jsonResp.hits[0].largeImageURL);
				img.setAttribute("class", "image-home");
                body.appendChild(img);
            });
    </script>

		
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