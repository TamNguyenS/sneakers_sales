<?php
session_start();
require './func.php';
require './db.php';

?>
<?php
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
		$_SESSION['id'] = $info['id'];
		$_SESSION['username'] = $info['username'];
		$_SESSION['position'] = $info['position'];
		$_SESSION['photo'] = $info['photo'];
		$msg = 'Ban da dang nhap thanh cong';
		header('Location: main/index.php');
		exit;
	} else {
		$error = "Ten tai khoan hoac mat khau Khum dung";
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
			<h4 style="color:red; font-weight: bold; margin: 5px;" ><?php echo $error ?></h4>
		
			<div class="checkbox-content">
				<label class="container">Remember me
					<input type="checkbox" checked="checked">
					<span class="checkmark"></span>
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
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
</body>
<!-- <script type="text/javascript">
	$(document).ready(function() {
		$('#buttonLogin').click(function() {
			let string = "<php echo $error ?>";
			let length = string.length;
			let string1 = "?php echo $msg ?>";
			let length1 = string.length;
			if (length != 0) {
				showErrorToast(string);
				console.log(string);
				return false;
			} else if (length1 != 0) {
				string = '';
				console.log(string1);
				showSuccessToast();
				return false;
			}

		});

		function showSuccessToast() {
			toast({
				title: "Thành công!",
				message: "Bạn đã đăng nhập thành công tại Hikky's shop.",
				type: "success",
				duration: 5000
			});
		}

		function showErrorToast(error) {

			toast({
				title: "Đăng nhập thất bại!",
				message: error,
				type: "error",
				duration: 5000
			});
		}

	});
</script> -->

</html>