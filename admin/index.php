<?php
session_start();
require './func.php';
require './db.php';
$cookies_temp = isset($_COOKIE['token_remem']) ? isset($_COOKIE['token_remem'])  : false;
if ($cookies_temp != false) {

	$token = $_COOKIE['token_remem'];
	$sql = "SELECT * FROM admin WHERE token = '$token' limit 1";
	$record = get_list($sql);
	$conn = connect();
	$query = "SELECT * FROM admin WHERE token = '$token'";
	$result = mysqli_query($conn, $query);
	$number_rows = mysqli_num_rows($result);
	if ($number_rows == 1) {
		$_SESSION['id'] = $record[0]['id'];
		$_SESSION['username'] = $record[0]['username'];
		$_SESSION['position'] = $record[0]['position'];
		$_SESSION['photo'] = $record[0]['photo'];
	}
}

if (isset($_SESSION['id'])) {
	header('location: ./main');
	exit;
}

?>

<?php
if (isset($_POST['remember'])) {
	$remember = true;
} else {
	$remeber = false;
}

$email = isset($_POST['email']) ? $_POST['email'] : false;
$password = isset($_POST['password']) ? $_POST['password'] : false;
$isEnror = false;
$error = '';
$msg = '';

if ($email != false && $password != false) {

	$conn = connect();
	$query = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";

	$result = mysqli_query($conn, $query);

	$number_rows = mysqli_num_rows($result);
	if ($number_rows == 1) {

		$info = mysqli_fetch_array($result);
		$id = $info['id'];
		$_SESSION['id'] = $id;
		$_SESSION['username'] = $info['username'];
		$_SESSION['position'] = $info['position'];
		$_SESSION['photo'] = $record[0]['photo'];
		if ($remember) {
			$token = uniqid($info['username'] . '_', true);
			$update_token = update('admin', array('token' => $token), "id = $id");

			setcookie('token_remem', $token, time() + (24 * 30), '/', '', 0);
		}
		$msg = 'Ban da dang nhap thanh cong';
		header('Location: main/index.php');
		exit;
	} else {
		$error = "Tên tài khoản và mật khẩu khum đúng! ";
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Administrator</title>
	<link rel="stylesheet" href="./css/csslogin.css?v=2">
	<link rel="stylesheet" href="./css/toast.css?v=2">

	<!-- icon -->
	<script src="https://kit.fontawesome.com/945e1fd97f.js" crossorigin="anonymous"></script>


	<script src="./js/toast.js"> </script>
</head>

<body>
	<div id="toast"></div>
	<div class="center">

		<div class="logo">
			<img src="./img/logo.png" alt="logo" class="logo">
		</div>
		<h1>Wellome to Hikky's</h1>
		<h2>Administrator dashboard home</h2>
		<!-- <div style="margin:5px;   text-align: center; "> -->
		<span style="color:red; font-weight: bold;"><?php echo $error ?></span>
		<!-- </div> -->
		<form method="POST" action="">
			<div class="txt_field">
				<input type="text" value="" name="email" required>
				<span></span>
				<label>Username</label>
			</div>
			<div class="txt_field">
				<input type="password" value="" name="password" required>
				<span></span>
				<label>Password</label>

			</div>



			<div class="pass">Forgot Password?</div>

			<input onclick="" type="submit" value="Login" id="buttonLogin">


			<div class="checkbox-content">
				<label class="container">Remember me
					<input type="checkbox" name="remember">
				</label>
			</div>


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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
<!-- ajax check password and username -->
<script type="text/javascript">
	// function showSuccessToast() {
	// 	toast({
	// 		title: "Thành công!",
	// 		message: "Bạn đã đăng nhập thành công tại Hikky's shop.",
	// 		type: "success",
	// 		duration: 5000
	// 	});
	// }

	$(document).ready(function() {
		$('#buttonLogin').click(function() {

		});
	});

	function showErrorToast(error) {

		toast({
			title: "Đăng nhập thất bại!",
			message: error,
			type: "error",
			duration: 5000
		});
	}
</script>

</html>