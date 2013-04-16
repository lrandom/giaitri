<?php
include('css/forum-header.php');
?>
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