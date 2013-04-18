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
		$('#form-add-role').validate({
			rules : {
				txtRole : {
					required : true,
					remote:{
						url:'<?php echo base_url() ?>admin/Role/checkRoleExist',
						type:"post",
						data:{
							txtRole:function(){
								return $('#form-add-role :input[name="txtRole"]').val();
							}
						}
					}
				}
			},
			messages : {
				txtRole : {
					required : required_messager,
					remote: $.validator.format("{0} đã tồn tại")
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
			Thêm vai trò
		</legend>
		<form class="form-horizontal" id="form-add-role" method="post">
			<input type="hidden" value="<?php echo $token ?>" name="token" id="token">
			<div class="control-group">
				<label class="control-label" for="txtRole">Tên vai trò</label>
				<div class="controls">
					<input type="text" id="txtRole" name="txtRole" placeholder="Tên vai trò"/>
				</div>
			</div>

			<div class="control-group">
				<div class="controls">
					<button type="submit" class="btn">
					  <?php echo ADD_LABEL; ?>
					</button>
					<a href="<?php echo $back_link ?>" class="btn">
						Quay lại
					</a>
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