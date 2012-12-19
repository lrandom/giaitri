<?php
$CI = &get_instance();
?>
<!DOCTYPE html5>
<html>
	<?php
	$CI -> load -> view('back_end/includes/header.php');
	?>

	<body>
		<?php
		$CI -> load -> view('back_end/includes/nav_menu');
		?>
		<div class="container-fluid wrapper">

			<fieldset>
				<legend>
					Thêm người quản trị
				</legend>
				<form class="form-horizontal">
					<div class="control-group">
						<label class="control-label" for="txtFullName">Họ tên</label>
						<div class="controls">
							<input type="text" id="txtFullName" placeholder="Họ tên"/>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="txtEmail">Email</label>
						<div class="controls">
							<input type="text" id="txtEmail" placeholder="Email"/>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="txtPhone">Điện thoại</label>
						<div class="controls">
							<input type="text" id="txtPhone" placeholder="Điện thoại"/>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="txtUserName">Tên đăng nhập</label>
						<div class="controls">
							<input type="text" id="txtUserName" placeholder="Tên đăng nhập"/>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="txtPassword">Mật khẩu</label>
						<div class="controls">
							<input type="text" id="txtPassword" placeholder="Mật khẩu"/>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="txtRepass">Nhắc lại mật khẩu</label>
						<div class="controls">
							<input type="text" id="txtRepass" placeholder="Nhắc lại mật khẩu"/>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="txtRole">Vai trò</label>
						<div class="controls">
							<select id="txtRole">
								<option value="">Vai trò 1</option>
								<option value="">Vai trò 2</option>
							</select>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<button type="button" class="btn">
								Thêm
							</button>
							<button type="button" class="btn">
								Hủy
							</button>
						</div>
					</div>
				</form>
			</fieldset>
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