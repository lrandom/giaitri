<?php 
$CI =& get_instance();
?>
<!DOCTYPE html>
<html>
<head>
	<?php 
	$CI -> load -> view('back_end/includes/header.php');
	?>
</head>

<body>
	
	<?php
	$CI -> load -> view('back_end/includes/nav_menu');
	?>
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