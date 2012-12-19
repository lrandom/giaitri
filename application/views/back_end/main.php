<!DOCTYPE html5>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Đăng nhập admin</title>
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>cssframework/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>cssframework/bootstrap/css/bootstrap-responsive.min.css"/>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>cssframework/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				//Add Hover effect to menus
				jQuery('ul.nav li.dropdown').hover(function() {
					jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn();
				}, function() {
					jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut();
				});
				$('.dropdown-toggle').dropdown();
			})
		</script>
	</head>

	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
					<a class="brand" href="#">Administrator</a>

					<div class="nav-collapse collapse">

						<ul class="nav pull-right">

							<li >
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Xin chào Lrandom <b class="caret"></b> </a>
								<ul class="dropdown-menu">
									<li>
										<a>Thay đổi thông tin cá nhân</a>
									</li>
									<li>
										<a>Thay đổi mật khẩu</a>
									</li>
									<li>
										<a>Thoát</a>

									</li>
								</ul>
							</li>
						</ul>

						<ul class="nav">
							<li class="active dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Bài đăng <span class="badge badge-info">8</span></a>
								<ul class="dropdown-menu">
									<li>
										<a>Quản lí bài đăng</a>
									</li>
									<li>
										<a>Bài đăng mới nhất</a>
									</li>

									<li>
										<a>Bài đăng cũ nhất</a>

									</li>
								</ul>
							</li>

							<li class="dropdown">
								<a href="#contact">Chuyên mục</a>
								<ul class="dropdown-menu">
									<li>
										<a> Quản lí chuyên mục </a>
									</li>
									<li>
										<a>12 cung hoàng đạo</a>
									</li>
									<li>
										<a>Truyện cười</a>
									</li>
									<li>
										<a>Ảnh vui</a>
									</li>
									<li>
										<a>Video</a>
									</li>
								</ul>
							</li>

							<li class="dropdown">
								<a href="#about">Phân quyền</a>
								<ul class="dropdown-menu">
									<li>
										<a>Vai trò</a>
									</li>
									<li>
										<a>Chức năng truy cập</a>
									</li>
									<li>
										<a> Thành viên </a>
									</li>
								</ul>
							</li>

							<li class="dropdown">
								<a href="#contact">Bình luận</a>
								<ul class="dropdown-menu">
									<li>
										<a>Quản lí bình luận</a>
									</li>

									<li>
										<a>Bình luận mới</a>
									</li>
								</ul>
							</li>

							<li>
								<a href="">Logo</a>
							</li>

							<li>
								<a href="">Quảng cáo</a>
							</li>
							<li>
								<a href="">File</a>
							</li>
							<li>
								<a href="#contact">Cài đặt</a>
							</li>
							<li>
								<a href="#">Thống kê google</a>
							</li>

						</ul>
					</div>
					<!--/.nav-collapse -->

				</div>
			</div>
		</div>
		<!--end nav bar-->

		<style>
			.wrapper {

			}

		</style>
		<div class="container-fluid wrapper">
			<div class="navbar">
				<div class="navbar-inner">

					<div class="btn-group">
						<button class="btn">
							Thêm
						</button>
					</div>

					<div class="btn-group">
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Hiển thị theo chuyên mục<span class="caret"></span> </a>
						<ul class="dropdown-menu">
							<li>
								<a>12 cung hoàng đạo</a>
							</li>

						</ul>
					</div>

					<div class="btn-group">
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Hiển thị theo<span class="caret"></span> </a>
						<ul class="dropdown-menu">
							<li>
								<a>Tin trong ngày</a>
							</li>
							<li>
								<a>Tin chờ duyệt</a>
							</li>
							<li>
								<a>Tin được duyệt</a>
							</li>

						</ul>
					</div>

					<div class="btn-group">

						<div class="input-append">
							<select class="btn option-search">
								<option>Giá trị 1</option>
								<option>Giá trị 2</option>
							</select>
							<input class="span2 input-medium search-query" id="appendedInputButton" type="text">
							<button class="btn" type="button">
								Tìm kiếm
							</button>
						</div>
					</div>
					<style>
					</style>
				</div>

			</div>

			<div class="row-fluid wrapper">
				<div class="span12 ">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Tên thành viên</th>
								<th>Email</th>
								<th>Năm sinh</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td>Xin chào</td>
								<td>Keke</td>
								<td>Keke</td>
							</tr>
							<tr>
								<td>Xin chào</td>
								<td>Keke</td>
								<td>Keke</td>
							</tr>
							<tr>
								<td>Xin chào</td>
								<td>Keke</td>
								<td>Keke</td>
							</tr>
							<tr>
								<td>Xin chào</td>
								<td>Keke</td>
								<td>Keke</td>
							</tr>
							<tr>
								<td>Xin chào</td>
								<td>Keke</td>
								<td>Keke</td>
							</tr>
							<tr>
								<td>Xin chào</td>
								<td>Keke</td>
								<td>Keke</td>
							</tr>
							<tr>
								<td>Xin chào</td>
								<td>Keke</td>
								<td>Keke</td>
							</tr>
						</tbody>
					</table>
					<div class="pagination">
						<ul>
							<li class="active">
								<a>1</a>
							</li>
							<li>
								<a>1</a>
							</li>
							<li>
								<a>1</a>
							</li>
							<li>
								<a>1</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!--end row fluid-->
			<hr>

			<?php
			$CI = &get_instance();
			$CI -> load -> view('back_end/includes/footer');
			?>
		</div><!--/.fluid-container-->
	</body>
</html>