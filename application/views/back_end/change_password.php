<?php
$CI = &get_instance();
?>
<!DOCTYPE html>
<html>
<?php
$CI -> load -> view('back_end/includes/header.php');
?>
<body>
	<?php
	$CI -> load -> view('back_end/includes/nav_menu');
	?>
	<script type="text/javascript" src="<?php echo base_url() ?>jqplugin/jquery_validation/jquery.validate.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		var required_messager = "Vui lòng không bỏ trống dòng này";
		var digits_messager = "Vui lòng chỉ điền số";
		$.validator.addMethod("password", function(value, element) {
			return this.optional(element) || /^[A-Za-z0-9!@#$%^&*()_]{6,50}$/i.test(value);
		}, "Mật khẩu từ 6 đến 50 kí tự");

		$('#form-add-user').validate({
			rules : {
				txtPassword : {
					required : true,
					password : true
				},
				txtRepass : {
					required : true,
					equalTo : "#txtPassword"
				},
				txtOldPass:{
					required:true,
					password:true
				}
			},
			messages : {
				txtPassword : {
					required : required_messager
				},
				txtRepass : {
					required : required_messager,
					equalTo : "Mật khẩu không trùng khớp"
				},
				txtOldPass:{
					required:required_messager
				}
			},
			errorClass : "help-inline",
			errorElement : "span",
			highlight : function(element, errorClass, validClass) {
				$(element).parents('.control-group').removeClass('success');
				$(element).parents('.control-group').addClass('error');
			},
			unhighlight : function(element, errorClass, validClass) {
				$(element).parents('.control-group').removeClass('error');
				$(element).parents('.control-group').addClass('success');
			}
		});
	})
</script>
<div class="container-fluid wrapper">

	<!--show alert messager-->
	<?php 
	if(isset($alert_state)){
		?>
		<div class='alert alert-<?php echo $alert_state; ?>'>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php echo $alert_msg; ?>
		</div>
		<?php
	}
	?>
	<!--end show alert messager-->

	<fieldset>
		<legend>
			<?php echo $title ?>
		</legend>
		<form class="form-horizontal" id="form-add-user" name="form-add-user" method="post">
			<div class="control-group">
				<label class="control-label" for="txtPassword">Mật khẩu mới</label>
				<div class="controls">
					<input type="password" id="txtPassword" name="txtPassword" placeholder="Mật khẩu"/>
				</div>
			</div>


			<div class="control-group">
				<label class="control-label" for="txtRepass">Nhắc lại mật khẩu</label>
				<div class="controls">
					<input type="password" id="txtRepass" name="txtRepass" placeholder="Mật khẩu"/>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="txtOldPass">Mật khẩu cũ</label>
				<div class="controls">
					<input type="password" id="txtOldPass" name="txtOldPass" placeholder="Xác nhận bằng mật khẩu cũ"/>
				</div>
			</div>


			<div class="control-group">
				<div class="controls">
					<button type="submit" class="btn">
						Thay đổi
					</button>
					<a href="<?php echo base_url() ?>user" class="btn">
						Quay lại
					</a>
				</div>
			</div>
		</form>
	</fieldset>

	<hr>
	<?php
	$CI = &get_instance();
	$CI -> load -> view('back_end/includes/footer');
	?>
</div>
<!--end row fluid-->
</div>
<!--/.fluid-container-->
</body>
</html>