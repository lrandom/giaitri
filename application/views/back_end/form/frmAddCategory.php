<?php
$CI = &get_instance();
?>
<!DOCTYPE html5>
<html>
	<?php
	$CI -> load -> view('back_end/includes/header.php');
	?>
	<script type="text/javascript" src="<?php echo base_url() ?>jqplugin/jquery_validation/jquery.validate.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var required_messager="Vui lòng không bỏ trống dòng này";
			var digits_messager="Vui lòng chỉ điền số";
			$('#form-add-category').validate({
				rules : {
					txtCategory : {
						required:true,
						minlength:3,
						maxlength:100
					},
					txtIndexMenu : {
						required:true,
						digits:true,
						range:[1,100]
					},
					txtLevel:{
						required:true,
						digits:true,
						range:[1,10]
					},
					txtDesc:{
						required:true
					}
				},
				messages : {
					txtCategory : {
					  required:required_messager,
					  minlength:"Độ dài kí tự phải lớn hơn 3 và nhỏ hơn 100",
					  maxlength:"Độ dài kí tự phải lớn hơn 3 và nhỏ hơn 100"
					},
					txtIndexMenu:{
				      required:required_messager,
				      digits:digits_messager,
				      range:"Chỉ nhập giá trị từ 1 tới 100"
					},
					txtLevel:{
					  required:required_messager,
					  digits:digits_messager,
					  range:"Chỉ từ 1 tới 10"
					},
					txtDesc:{
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
			})//end validate form
		})
	</script>
	<body>
		<?php
		$CI -> load -> view('back_end/includes/nav_menu');
		?>
		<div class="container-fluid wrapper">
			<form class="form-horizontal" id="form-add-category">
				<fieldset>
					<legend>
						Thêm mới chuyên mục
					</legend>
					<div class="control-group">
						<label class="control-label" for="txtCategory">Tên chuyên mục</label>
						<div class="controls">
							<input type="text" id="txtCategory" name="txtCategory" placeholder="Tên chuyên mục">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="txtIndeMenu">Thứ tự trên menu top</label>
						<div class="controls">
							<input type="text"  id="txtIndexMenu" name="txtIndexMenu" placeholder="Thứ tự trên menu">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="txtLevel">Cấp độ chuyên mục</label>
						<div class="controls">
							<input type="text" id="txtLevel" name="txtLevel" placeholder="Cấp độ chuyên mục">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="txtTargetParent">Chuyên mục cha</label>
						<div class="controls">
							<select id="txtTargetParent" name="txtTargetParent">
								<option>Chuyên mục 1</option>
								<option>Chuyên mục 2</option>
							</select>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="txtDesc">Miêu tả</label>
						<div class="controls">
							<textarea id="txtDesc" name="txtDesc">
					   </textarea>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<button type="submit" class="btn" >
								Thêm
							</button>
							<button type="button" class="btn">
								Hủy
							</button>
						</div>
					</div>
				</fieldset>
			</form>
			<!--end form-->
		</div>
		<!--end container fluid-->
	</body>
</html>