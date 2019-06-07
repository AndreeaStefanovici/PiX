<?php include('server.php') ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PiX-Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="imagini/logo.jpg" style="width:100%;">
	<link rel="stylesheet" type="text/css" href="css/register_css.css"> 

</head>
<body>

<header>

<div class="space"></div>

<div class="dropdown">
	<button class="dropbtn">Register here<span class="arrow">&#9660;</span></button>	
</div>
</header>

<form method="post" action="register.php">
  	
	  <div class = "body_wrapper">
        <div class = "little_icon_container">
            <div class = "little_icon">
                <img class = "icon" src="imagini/register.jpg" alt="logo" >
            </div>
        </div>

        <div class = "form_wrapper">
            <div class = "username_and_input">
                <div class = "username">
                    <label>Username</label>
                </div>
                <input class = "input_fields" type = "text"  name="username" value="<?php echo $username; ?>">
            </div>
			
			<div class = "email_and_input">
                <div class = "email">
                    <label>Email</label>
                </div>
                <input class = "input_fields" type="email" name="email" value="<?php echo $email; ?>">
            </div>

            <div class = "password_and_input">
                <div class = "password">
                    <label>Password</label>
                </div>
                <input class = "input_fields" type="password" name="password_1">
            </div>
			
			<div class = "password_and_input">
                <div class = "password">
                    <label>Confirm Password</label>
                </div>
                <input class = "input_fields" type="password" name="password_2">
            </div>
        </div>
		<div>
		<?php include('errors.php'); ?>
		</div>

        <div class = "submit_buttons">
			
            <button class = "buttons" id = "register"  type="submit"  name="reg_user">Register</button>
			

        </div>

       
        </div>
<form>    


</body>
</html>