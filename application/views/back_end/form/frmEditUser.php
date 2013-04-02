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
			$(document).ready(function () {
			    var required_messager = "Vui lòng không bỏ trống dòng này";
			    var digits_messager = "Vui lòng chỉ điền số";
			    $.validator.addMethod('email', function (value, element) {
			        return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(value);
			    }, "Vui lòng điền đúng định dạng email");

			    $.validator.addMethod("username", function (value, element) {
			        return this.optional(element) || /^[a-zA-Z0-9._-]{6,50}$/i.test(value);
			    }, "Tên đăng nhập từ 6-50 kí tự");

			    $.validator.addMethod("password", function (value, element) {
			        return this.optional(element) || /^[A-Za-z0-9!@#$%^&*()_]{6,50}$/i.test(value);
			    }, "Mật khẩu từ 6 đến 50 kí tự");

			    $.validator.addMethod("phone", function (value, element) {
			        return this.optional(element) || /^(([0-9]{1})*[- .(]*([0-9]{3})[- .)]*[0-9]{3}[- .]*[0-9]{4})+$/i.test(value);
			    }, "Vui lòng nhập đúng định dạng");

			    $('#form-add-user').validate({
			        rules: {
			            txtFullName: {
			                required: true,
			            },
			            txtEmail: {
			                required: true,
			                email: true,
			                remote: {
			                    url: '<?php echo base_url() ?>User/checkEmailExistEdit',
			                    type: "post",
			                    data: {
			                        txtEmail: function () {
			                            return $('#form-add-user :input[name="txtEmail"]').val();
			                        },
			                        id: function () {
			                            return $('#form-add-user :input[name="txtID"]').val();
			                        }
			                    }
			                }
			            },
			            txtPhone: {
			                required: true,
			                phone: true,
			                remote: {
			                    url: '<?php echo base_url() ?>User/checkPhoneExistEdit',
			                    type: 'post',
			                    data: {
			                        txtPhone: function () {
			                            return $('#form-add-user :input[name="txtPhone"]').val();
			                        },
			                        id: function () {
			                            return $('#form-add-user :input[name="txtID"]').val();
			                        }
			                    }
			                }
			            },
			            txtUserName: {
			                required: true,
			                username: true,
			                remote: {
			                    url: '<?php echo base_url() ?>User/checkUserExist',
			                    type: "post",
			                    data: {
			                        txtUserName: function () {
			                            return $('#form-add-user :input[name="txtUserName"]').val();
			                        }
			                    }
			                }
			            },
			            txtPassword: {
			                required: true,
			                password: true
			            },
			            txtRepass: {
			                required: true,
			                equalTo: "#txtPassword"
			            }
			        },
			        messages: {
			            txtFullName: {
			                required: required_messager
			            },
			            txtEmail: {
			                required: required_messager,
			                remote: $.validator.format("{0} đã tồn tại")
			            },
			            txtPhone: {
			                required: required_messager,
			                remote: $.validator.format("{0} đã tồn tại")
			            },
			            txtUserName: {
			                required: required_messager,
			                remote: $.validator.format("{0} đã tồn tại")
			            },
			            txtPassword: {
			                required: required_messager
			            },
			            txtRepass: {
			                required: required_messager,
			                equalTo: "Mật khẩu không trùng khớp"
			            }
			        },
			        errorClass: "help-inline",
			        errorElement: "span",
			        highlight: function (element, errorClass, validClass) {
			            $(element).parents('.control-group').removeClass('success');
			            $(element).parents('.control-group').addClass('error');
			        },
			        unhighlight: function (element, errorClass, validClass) {
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
				<button type="button" class="close" data-dismiss="alert">
					&times;
				</button>
				<?php echo $alert_msg; ?>
			</div>
			<?php
			}
			?>
			<!--end show alert messager-->

			<fieldset>
				<legend>
					Thay đổi thông tin thành viên
				</legend>
				<form class="form-horizontal" id="form-add-user" name="form-add-user" method="post">
					<div class="control-group">
						<label class="control-label" for="txtID">ID</label>
						<div class="controls">
							<input type="text" id="txtID" name="txtID" disabled="disabled" value="<?php echo $user[0]->user_id?>"/>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="txtFullName">Họ tên</label>
						<div class="controls">
							<input type="text" id="txtFullName" name="txtFullName" placeholder="Họ tên" value="<?php echo $user[0]->full_name ?>"/>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="txtEmail">Email</label>
						<div class="controls">
							<input type="text" id="txtEmail" name="txtEmail" placeholder="Email" value="<?php echo $user[0]->email ?>"/>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="txtPhone">Điện thoại</label>
						<div class="controls">
							<input type="text" id="txtPhone" name="txtPhone" placeholder="Điện thoại" value="<?php echo $user[0]->phone ?>"/>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="txtRole">Vai trò</label>
						<div class="controls">
							<select id="txtRole" name="txtRole">
								<?php
								if (isset($role)) {
									foreach ($role as $r) {
										if ($r -> id == $user[0] -> role_id) {
											echo '<option selected="selected" value="' . $r -> id . '">' . $r -> name . '</option>';
										} else {
											echo '<option value="' . $r -> id . '">' . $r -> name . '</option>';
										}
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
						      <option value="<?php echo ACTIVED_STATE ?>">Kích hoạt</option>
						      <option value="<?php echo DISABLED_STATE ?>">Khóa</option>		
							</select>
                        </div>
					</div>
					
					<div class="control-group">
						<div class="controls">
							<button type="submit" class="btn">
								Sửa
							</button>
							<a href="<?php echo base_url() ?>user" class="btn"> Quay lại </a>
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