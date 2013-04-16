<?php
$CI = &get_instance();
?>
<!DOCTYPE html>
<html>
	<?php
	$CI -> load -> view('back_end/includes/header.php');
	?>
	<script type="text/javascript" src="<?php echo base_url() ?>jqplugin/jquery_validation/jquery.validate.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var required_messager = "Vui lòng không bỏ trống dòng này";
			var digits_messager = "Vui lòng chỉ điền số";
			$('#form-add-category').validate({
				rules : {
					txtName : {
						required : true,
						minlength : 3,
						maxlength : 100,
					    remote:{
							  url:'<?php echo base_url() ?>admin/Category/checkNameExistEdit',
							  type:"post",
							  data:{
							  	txtName:function(){
							  		return $('#form-add-category :input[name="txtName"]').val();
							  	},
							  	id:function(){
							  		return $('#form-add-category :input[name="id"]').val();
							  	}
							  }
					    }
					},
					txtOrderTopMenu : {
						required : true,
						digits : true,
						range : [1, 100],
					    remote:{
							  url:'<?php echo base_url() ?>admin/Category/checkOrderExistEdit',
							  type:"post",
							  data:{
							  	txtOrderTopMenu:function(){
							  		return $('#form-add-category :input[name="txtOrderTopMenu"]').val();
							  	},
							  	id:function(){
							  		return $('#form-add-category :input[name="id"]').val();
							  	}
							  }
					    }
					}
				},
				messages : {
					txtName : {
						required : required_messager,
						minlength : "Độ dài kí tự phải lớn hơn 3 và nhỏ hơn 100",
						maxlength : "Độ dài kí tự phải lớn hơn 3 và nhỏ hơn 100",
						remote:$.validator.format("{0} đã tồn tại")
					},
					txtOrderTopMenu : {
						required : required_messager,
						digits : digits_messager,
						range : "Chỉ nhập giá trị từ 1 tới 100",
						remote:$.validator.format("{0} đã tồn tại")
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
			})//end validate form
		})
	</script>
	<body>
		<?php
		$CI -> load -> view('back_end/includes/nav_menu');
		?>
		<div class="container-fluid wrapper">
			<!--show alert messager-->
			<?php
if(isset($alert_state)){
			?>
			<div class='alert alert-<?php echo $alert_state; ?>'>
				<button type="button" class="close" data-dismiss="alert">
					&times;
				</button>
				<?php echo $alert_msg; ?>
			</div>
			<?php
			}
			?>
			<!--end show alert messager-->
			<form class="form-horizontal" id="form-add-category" method="post">
				<input type="hidden" name="id" value="<?php echo $category[0]->id ?>"/>
				<fieldset>
					<legend>
						Thêm mới chuyên mục
					</legend>
					<div class="control-group">
						<label class="control-label" for="txtName">Tên chuyên mục</label>
						<div class="controls">
							<input type="text" id="txtName" name="txtName" placeholder="Tên chuyên mục" value="<?php echo $category[0]->name ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="txtOrderTopMenu">Thứ tự trên top Menu</label>
						<div class="controls">
							<input type="text"  id="txtOrderTopMenu" name="txtOrderTopMenu" placeholder="Thứ tự trên top menu" value="<?php echo $category[0]->order_top_menu ?>">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="txtParentId">Chuyên mục cha</label>
						<div class="controls">
							<select id="txtParentId" name="txtParentID">
								<option value="0"></option>
								<?php
								if (isset($cat_parent_list)) {
									foreach ($cat_parent_list as $r) {
										echo '<option value="' . $r -> id . '">' . $r -> name . '</option>';
									}
								}
								?>
							</select>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="txtState">Trạng thái</label>
						<div class="controls">
							<select id="txtState" name="txtState">
								<option value="<?php echo DISABLED_STATE ?>">Vô hiệu</option>
								<option value="<?php echo ACTIVED_STATE ?>">Kích hoạt</option>
							</select>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<button type="submit" class="btn" >
								<?php echo EDIT_LABEL; ?>
							</button>
							<a class="btn" href="<?php echo $back_link; ?>"> Quay lại </a>
						</div>
					</div>
				</fieldset>
			</form>
			<!--end form-->
		</div>
		<!--end container fluid-->
	</body>
</html>