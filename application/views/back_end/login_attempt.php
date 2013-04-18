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
  function reload_captcha_image(){
    date=new Date();
    var image_link = '<?php echo base_url() ?>captcha/load_captcha_login_attempts?_='+date.getTime();
    $('.captcha_image').attr('src',image_link);
  }
</script>
<style type="text/css" media="screen">
<style type="text/css">
body {
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #f5f5f5;
}

.form-login-attempt {
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

.form-login-attempt{
	margin-bottom: 10px;
}

.form-login-attempt input[type="text"], .form-login-attempt input[type="password"] {
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

.input-append{
  margin-top: 8px;
}

#captcha_code{
	height: 18px;
	width: 205px;
}

</style>
</head>
<body>
	<div class="container" >
		<form class="form-login-attempt" method="post" >
			<div class="alert">
				<p>Bạn đang cố tình đăng nhập vào hệ thống của chúng tôi, vui lòng xác nhận mã bên dưới !</p>
			</div>
			<div style="margin-top: -12px;">
				<!--captcha-->
				<img class="captcha_image" src="<?php echo base_url();?>captcha/load_captcha_login_attempts" alt="" >				
				<img src="<?php echo base_url();?>resources/reload_40_40.png" alt="Tải lại captcha" title="Tải lại captcha" style="cursor:pointer;" onclick="reload_captcha_image()">
            </div>
            
            <div class="input-append">
				<input class="span2" id="captcha_code" name="captcha_code" type="text">
				<button class="btn btn_confirm" type="submit">Xác nhận</button>
			</div>
		</form>
	</div>
	<!--end container -->
</body>
</html>