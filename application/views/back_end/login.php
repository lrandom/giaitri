<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php echo $title; ?></title>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>
cssframework/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>
cssframework/bootstrap/css/bootstrap-responsive.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>
css/admin/main.css">
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>cssframework/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>jqplugin/jquery_validation/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var required_messager = "Vui lòng không bỏ trống dòng này";
	var digits_messager = "Vui lòng chỉ điền số";
	$('.form-login').validate({
		rules : {
			username : {
				required : true,
				maxlength : 50,
				minlength : 5
			},
			password : {
				required : true,
				maxlength :50,
				minlength : 5
			}
		},
		messages : {
			username : {
				required : required_messager,
				minlength : "Độ dài tối thiểu là 5 kí tự",
				maxlength : "Độ dài kí tự phải nhỏ hơn 50 kí tự"
			},
			password : {
				required : required_messager,
				minlength:"Độ dài tối thiểu là 5 kí tự",
				maxlength:"Độ dài kí tự phải nhỏ hơn 50 kí tự"
			}
		},
		errorClass : "error",
		errorElement : "span",
	})
	//end validation form
})	 
//end jquery document ready
</script>
</head>
<style type="text/css">
body {
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #f5f5f5;
}

.form-login {
	max-width: 300px;
	padding: 19px 29px 29px;
	margin: 0 auto 20px;
	background-color: #fff;
	border: 1px solid #e5e5e5;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
	-moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
	box-shadow: 0 1px 2px rgba(0,0,0,.05);
}

.form-login .form-login-heading, .form-login .checkbox {
	margin-bottom: 10px;
}

.form-login input[type="text"], .form-login input[type="password"] {
	font-size: 16px;
	height: auto;
	margin-bottom: 8px;
	padding: 5px 5px;
}
.error{
	color:red;
	display: block;
	overflow: hidden;
	margin-bottom: 8px;
	padding-left: 5px;
}	
</style>

<body>
	<div class="container">
		<form class="form-login" method="post">
			<h3 class="form-login-heading">Đăng nhập quản trị</h3>

			<!-- username -->
			<input name="username" id="username" type="text" class="input-block-level" placeholder="Tên đăng nhập" size="50">
			<span class="error"><?php echo form_error('username'); ?></span>

			<!-- password -->
			<input name="password" id="password" type="password" class="input-block-level" placeholder="Mật khẩu" size="50">
			<span class="error"></span>

			<!-- remember me -->
			<label class="checkbox">
				<input type="checkbox" value="remember_me" name="remember_me" id="remember_me">Remember me
			</label>
            <span class="error"><?php if(isset($error_msg)) {echo $error_msg;} ?></span>


			<button class="btn" type="submit">Đăng nhập</button>

		</form>
	</div>
	<!--end container -->
</body>
</html>