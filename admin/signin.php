<?php 
require './func.php';
require './db.php';

$username = isset($_POST['username']) ? $_POST['username'] : false;
$password = isset($_POST['password']) ? $_POST['password'] : false;

$isEnror = false;
$Enror = '';

if($username != false && $password != false){
	
	$query = "select * FROM admin where username = $username";


}



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Administrator</title>
	<link rel="stylesheet" href="./css/csslogin.css">
	<!-- icon -->
	<script src="https://kit.fontawesome.com/945e1fd97f.js" crossorigin="anonymous"></script>
</head>

<body>
	<div class="center">
	
		<div class="logo">
			<img src="./img/logo.png" alt="logo" class="logo" >
		</div>
		<h1>Wellome to Hikky's</h1>
		<h2>Administrator dashboard  home</h2>
		
		<form method="post" action="./index.php">
			<div class="txt_field">
				<input type="text" value="username" required>
				<span></span>
				<label>Username</label>
			</div>
			<div class="txt_field">
				<input type="password" value="password"  required>
				<span></span>
				<label>Password</label>
			</div>
			<div class="pass">Forgot Password?</div>
			<input type="submit" value="Login">
			<div class="signup_link">
				<h5>Contact with Hikky's social</h5>
				<div id="social-icon">
					<ul class="wrapper">
						<a href="https://www.facebook.com/TamNC29">
							<li class="icon facebook">
	
								<span class="tooltip">Facebook</span>
								<span><i class="fab fa-facebook"></i></span>
							</li>
						</a>
	
						<a href="https://twitter.com/TamNguy28327146">
							<li class="icon twitter">
								<span class="tooltip">Twitter</span>
								<span><i class="fab fa-twitter"></i></span>
	
							</li>
						</a>
						<a href="https://github.com/TamNguyenS">
							<li class="icon instagram">
								<span class="tooltip">Instagram</span>
								<span><i class="fab fa-instagram"></i></span>
	
							</li>
						</a>
						<a href="https://github.com/TamNguyenS">
							<li class="icon github">
								<span class="tooltip">Github</span>
								<span><i class="fab fa-github"></i></span> 
							</li>
						</a>
						<a href="https://www.youtube.com/channel/UC_aLW5yh278IJt2S4qTDIrA/featured">
							<li class="icon youtube">
								<span class="tooltip">Youtube</span>
								<span><i class="fab fa-youtube"></i></span>
							</li>
					</ul>
					</a>
				</div>
			</div>
		</form>

		

	</div>
			<!-- pop-up -->

</body>
</html>