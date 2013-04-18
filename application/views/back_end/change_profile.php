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
		$.validator.addMethod('email', function(value, element) {
			return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(value);
		}, "Vui lòng điền đúng định dạng email");

		$.validator.addMethod("username", function(value, element) {
			return this.optional(element) || /^[a-zA-Z0-9._-]{6,50}$/i.test(value);
		}, "Tên đăng nhập từ 6-50 kí tự");

		$.validator.addMethod("password", function(value, element) {
			return this.optional(element) || /^[A-Za-z0-9!@#$%^&*()_]{6,50}$/i.test(value);
		}, "Mật khẩu từ 6 đến 50 kí tự");

		$.validator.addMethod("phone", function(value, element) {
			return this.optional(element) || /^(([0-9]{1})*[- .(]*([0-9]{3})[- .)]*[0-9]{3}[- .]*[0-9]{4})+$/i.test(value);
		}, "Vui lòng nhập đúng định dạng");

		$('#form-change-profile').validate({
			rules : {
				txtEmail : {
					required : true,
					email : true,
					remote:{
						url:'<?php echo base_url() ?>User/checkEmailExistEdit',
						type:"post",
						data:{
							id:function(){
								return $('#form-change-profile :input[name="txtId"]').val();
							},
							txtEmail:function(){
								return $('#form-change-profile :input[name="txtEmail"]').val();
							}
						}
					}
				},
				txtPhone : {
					required : true,
					phone : true,
					remote:{
						url:'<?php echo base_url() ?>User/checkPhoneExistEdit',
						type:'post',
						data:{
							id:function(){
								return $('#form-change-profile :input[name="txtId"]').val();
							},
							txtPhone:function(){
								return $('#form-change-profile :input[name="txtPhone"]').val();
							}
						}
					}
				},
				txtPassword : {
					required : true,
					password : true
				}
			},
			messages : {
				txtEmail : {
					required : required_messager,
					remote: $.validator.format("{0} đã tồn tại")
				},
				txtPhone : {
					required : required_messager,
					remote: $.validator.format("{0} đã tồn tại")
				},
				txtUserName : {
					required : required_messager,
					remote: $.validator.format("{0} đã tồn tại")
				},
				txtPassword : {
					required : required_messager
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
		<form class="form-horizontal" id="form-change-profile" name="form-change-profile" method="post">
			<input type="hidden" id="txtId" name="txtId" value="<?php echo $user[0]->user_id ?>"> 
			<div class="control-group">
				<label class="control-label" for="txtEmail">Email</label>
				<div class="controls">
					<input type="text" id="txtEmail" name="txtEmail" 
					value="<?php echo $user[0]->email ?>"/>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="txtPhone">Điện thoại</label>
				<div class="controls">
					<input type="text" id="txtPhone" name="txtPhone"
					value="<?php echo $user[0]->phone ?>"/>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="txtPassword">Nhập mật khẩu xác nhận</label>
				<div class="controls">	
					<input type="password" id="txtPassword" name="txtPassword" 
					placeholder="Nhập mật khẩu xác nhận"/>
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