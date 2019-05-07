<?php include('server.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PiX-Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="imagini/logo.jpg" style="width:100%;">
	<link rel="stylesheet" type="text/css" href="login_css.css"> 

</head>
<body>

<header>

<div class="space"></div>

		
           <div class="dropdown">
	       <button class="dropbtn">Login here<span class="arrow">&#9660;</span></button>	
		   </div>
        
</header>

<form method="post" action="login.php">

	<div class = "body_wrapper">
        <div class = "little_icon_container">
            <div class = "little_icon">
                <img class = "icon" src="imagini/LoginRed.jpg" alt="logo">
            </div>
        </div>

        <div class = "form_wrapper">
            <div class = "username_and_input">
                <div class = "username">
                    <label>Username</label>
                </div>
                <input class = "input_fields" type = "text"  name="username" >
            </div>

            <div class = "password_and_input">
                <div class = "password">
                    <label>Password</label>
                </div>
                <input class = "input_fields" type="password" name="password">
            </div>
        </div>
        <?php include('errors.php'); ?>
        <div class = "submit_buttons">
		
            <button class = "buttons" id = "login" type="submit"  name="login_user" >Login</button>
           
		</div>
        </form> 
        <form action="register.php">
		<div class = "submit_buttons">
			
            <button class = "buttons" id = "register" >Register</button>
		

        </div>
</form>
        <div class = "cancel_container">
            
            <a href="login.html" class = "forgot_password">Forgot password? </a>
        </div>
   </div>
 
 
</body>

</html>