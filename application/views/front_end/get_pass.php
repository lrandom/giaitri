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
	$('.form-get-pass').validate({
		rules : {
			password : {
				required : true,
				maxlength :50,
				minlength : 5
			},
			cfpassword: {
				required : true,
				maxlength : 50,
				minlength : 5,
				equalTo : "#password"
			}
		},
		messages : {
			password : {
				required : required_messager,
				minlength:"Độ dài tối thiểu là 5 kí tự",
				maxlength:"Độ dài kí tự phải nhỏ hơn 50 kí tự"
			},
			cfpassword : {
				required : required_messager,
				minlength : "Độ dài tối thiểu là 5 kí tự",
				maxlength : "Độ dài kí tự phải nhỏ hơn 50 kí tự",
				equalTo : "Mật khẩu xác nhận không trùng khớp"
			}
		},
		submitHandler:function(){
			if ($('#term_of_services').is(':checked')) {
				$('.form-get-pass')[0].submit();
			} else {
				alert('Vui lòng chấp nhận điều khoản của chúng tôi');
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

.form-get-pass {
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

.form-get-pass .form-get-pass-heading, .form-get-pass .checkbox {
	margin-bottom: 10px;
}

.form-get-pass input[type="text"], .form-get-pass input[type="password"] {
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
		<form class="form-get-pass" method="post">
			<h5 class="form-get-pass-heading"><a href="#"><?php echo $name; ?></a>,vui lòng nhập mật khẩu của bạn</h5>

			<!-- password -->
			<input name="password" id="password" type="password" class="input-block-level" placeholder="Mật khẩu" size="50">
			<span class="error"></span>

			<!-- password -->
			<input name="cfpassword" id="cfpassword" type="password" class="input-block-level" placeholder="Xác nhận lại mật khẩu" size="50">
			<span class="error"></span>

			<!-- remember me -->
			<label>
				<input type="checkbox" value="" name="term_of_services" id="term_of_services">
				Tôi đã đọc và chấp nhận với <a href="#">điều khoản</a> website
			</label>

			<span class="error"><?php if(isset($error_msg)) {echo $error_msg;} ?></span>
			<button class="btn" type="submit">OK</button>
		</form>
	</div>
	<!--end container -->
</body>
</html>