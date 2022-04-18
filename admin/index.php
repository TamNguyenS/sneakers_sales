<?php
require './func.php';
require './db.php';

?>
<?php
$email = isset($_POST['email']) ? $_POST['email'] : false;
$password = isset($_POST['password']) ? $_POST['password'] : false;

$isEnror = false;
$Enror = '';

if ($email != false && $password != false) {
	$conn = connect();
	$query = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";

	$result = mysqli_query($conn, $query);

	$number_rows = mysqli_num_rows($result);
	if ($number_rows == 1) {
		session_start();
		$info = mysqli_fetch_array($result);
		$_SESSION['id'] = $info['id'];
		$_SESSION['username'] = $info['username'];
		$_SESSION['position'] = $info['position'];
		$_SESSION['photo'] = $info['photo'];
		header('Location: main/index.php');
		exit;
	}
	header('Location: ?error=ban dang nhap khong thanh cong');
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
			<img src="./img/logo.png" alt="logo" class="logo">
		</div>
		<h1>Wellome to Hikky's</h1>
		<h2>Administrator dashboard home</h2>

		<form method="POST" action="">
			<div class="txt_field">
				<input type="text" value="" name="email" class="" required>
				<span></span>
				<label>Username</label>
			</div>
			<div class="txt_field">
				<input type="password" value="" name="password" class="" required>
				<span></span>
				<label>Password</label>
			</div>
			<div class="pass">Forgot Password?</div>
			<input type="submit" value="Login">
		</form>
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




	</div>
	<!-- pop-up -->

</body>

</html>