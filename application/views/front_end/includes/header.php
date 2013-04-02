<?php $path = base_url();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="<?php echo $path ;?>css/style.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php echo $path ;?>jqplugin\nivoslider/nivo-slider.css" type="text/css" media="screen" />
  <title>Untitled Document</title>
  <script type="text/javascript" src="<?php echo $path ;?>jqplugin\nivoslider/jquery.min.js" ></script>
  <script type="text/javascript" src="<?php echo $path ;?>jqplugin\nivoslider/jquery.nivo.slider.js"></script>
  <script type="text/javascript" src="<?php echo $path ;?>jqplugin\nivoslider/jquery-ui.min.js" ></script>
  <script type="text/javascript" src="<?php echo $path ;?>jqplugin\nivoslider/jcarousellite_1.0.1.pack.js" ></script>
  <script type="text/javascript" src="<?php echo $path ;?>js/captify.tiny.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#featured > ul").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 3000, true);
  });
  </script>
</head>

<body>
  <div id="header">
    <div id="nav">
    <div id="logo"> <a href="#"><img src="<?php echo $path ;?>resources/header/logo.png" /></a> </div>
    <!--end logo-->

    <ul>
      <?php
      if($menu!=null){
      foreach ($menu as $r) {
       echo '
      <li>
        <a href="#">'.$r -> name .'</a>
      </li> 
      '; 
      }
    }
      ?>
    </ul>
    <div id="search">
      <input id="text-search" type="text" />
      <input id="button-search" type="button" />
    </div>
    <!--end search-->

    <div id="user">
      <div id="login"> <a href="#"><img src="<?php echo $path ;?>resources/header/login.png" /></a> </div>
      <!--end login-->

      <div id="dropdown">
        <div id="fb-login">
          <p>Đăng nhập với Facebook để bình luận và chia sẻ nội dung.</p>
          <a href="#"><img src="<?php echo $path ;?>resources/header/icon-fb.png" />Đăng nhập với Facebook</a> </div>
          <!--end fb-login--> 
        </div>
        <!--end dropdown--> 
      </div>
      <!--end user--> 
    </div><!--end nav-->
    </div>
<!--end header-->