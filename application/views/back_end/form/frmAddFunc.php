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
		<script type="text/javascript" src="<?php echo base_url() ?>jqplugin/jquery_validation/jquery.validate.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				var required_messager = "Vui lòng không bỏ trống dòng này";
				var digits_messager = "Vui lòng chỉ điền số";
				$('#form-add-app').validate({
					rules : {
						txtCode : {
							required : true,
						    remote:{
							  url:'<?php echo base_url() ?>admin/Func/checkCodeExist',
							  type:"post",
							  data:{
							  	txtRole:function(){
							  		return $('#form-add-role :input[name="txtCode"]').val();
							  	}
							  }
							}
						},
					    txtName : {
							required : true,
						    remote:{
							  url:'<?php echo base_url() ?>admin/Func/checkNameExist',
							  type:"post",
							  data:{
							  	txtRole:function(){
							  		return $('#form-add-role :input[name="txtName"]').val();
							  	}
							  }
							}
						}
                    },
					messages : {
						txtCode : {
							required : required_messager,
							remote: $.validator.format("{0} đã tồn tại")
						},
					    txtName : {
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
				  Thêm chức năng mới vào hệ thống
				</legend>
				<form class="form-horizontal" id="form-add-app" method="post">
					<input type="hidden" value="<?php echo $token ?>" name="token" id="token">
					<div class="control-group">
						<label class="control-label" for="txtName">Tên chức năng</label>
						<div class="controls">
							<input type="text" id="txtName" name="txtName" placeholder="Tên"/>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="txtCode">Mã code</label>
						<div class="controls">
							<input type="text" id="txtCode" name="txtCode" placeholder="Mã code"/>
						</div>
					</div>
					
					<div class="control-group">
						<div class="controls">
							<button type="submit" class="btn">
								Thêm
							</button>
							<a class="btn" href="<?php echo base_url()?>admin/func">
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