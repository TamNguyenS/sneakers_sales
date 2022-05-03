<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
	<div class="sidebar">
		<div class="sidebar-header">
			<img class="sidebar-header-logo" src="../img/logo.png" alt="logo-hikky">
			<p class="menu-webname">Hikky's shop</p>
		</div>
		<ul class="sidebar-menu">
			<li class="menu-item">
				<a href="../main/" class="menu-link"><i class="far fa-eye"></i> <span>Tổng quan</span> </a>
			</li>
			<li class="menu-item">
				<a href="../order/" class="menu-link"><i class="fa fa-shopping-cart"></i> <span>Đơn hàng</span> </a>
			</li>
			<li class="menu-item">
				<a href="../product/" class="menu-link"><i class="fa fa-shopping-bag"></i> <span>Sản phẩm</span></a>
				<button onclick="product_child()" class="dropbtn"> <i class="fas fa-angle-down" id="product_btn"></i>
				</button>
			</li>

			<li class="menu-item dropdown-content product">
				<a href="../product/productadd.php" class="menu-link"> <i class="fa-solid fa-caret-right"></i> <span> Thêm SP</span> <i class=""></i> </a>
			</li>

			<li class="menu-item dropdown-content product">
				<a href="../product/productadd.php" class="menu-link"> <i class="fa-solid fa-caret-right"></i> <span> Thống kê</span> <i class=""></i> </a>
			</li>
			<li class="menu-item">
				<a href="" class="menu-link"><i class="fas fa-user-plus"></i><span>Tài khoản</span></a>
				<button onclick="employee_child()" class="dropbtn"> <i class="fas fa-angle-down" id="employee_btn"></i>
				</button>
			</li>

			<li class="menu-item dropdown-content employee" >
				<a href="" class="menu-link"><i class="fa-solid fa-caret-right"></i> <span> Khách hàng</span>
				</a>
			</li>
			<li class="menu-item dropdown-content employee">
				<a href="" class="menu-link"><i class="fa-solid fa-caret-right"></i> <span> Nhân viên</span> 
				</a>
			</li>
			<li class="menu-item">
				<a href="../manufacture/" class="menu-link"><i class="fas fa-industry"></i><span>Nhà cung cấp</span></a>
				<button onclick="manufacturer_child()" class="dropbtn"> <i class="fas fa-angle-down" id="manufacturer_btn"></i>
			</button>
			</li>

			<li class="menu-item dropdown-content manufacturer" id="manufacturer">
				<a href="../manufacture/manufactureadd.php" class="menu-link"> <i class="fa-solid fa-caret-right"></i> <span> Thêm NCC</span> <i class=""></i></a>
			</li>
			<li class="menu-item">
				<a href="" class="menu-link"><i class="fa fa-info-circle"></i> <span>Thông tin</span> </a>
			</li>
		</ul>

	</div>

	<script>
		function product_child() {
			let product = document.getElementsByClassName('product');
			for (let i = 0; i < product.length; i++) {
				document.getElementsByClassName('product')[i].classList.toggle("show");
			}
			document.getElementById("product_btn").classList.toggle("rotation");
		}
		function employee_child() {
			let employee = document.getElementsByClassName('employee');
			for (let i = 0; i < employee.length; i++) {
				document.getElementsByClassName('employee')[i].classList.toggle("show");
			}

			document.getElementById("employee_btn").classList.toggle("rotation");

		}

		function manufacturer_child() {
			document.getElementById("manufacturer").classList.toggle("show");
			document.getElementById("manufacturer_btn").classList.toggle("rotation");
		}
	</script>
</body>

</html>