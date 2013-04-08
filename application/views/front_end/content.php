<?php $path = base_url();?>
<div id="container">
  <div id="content">
    <div id="left-content">
      <div id="menu-content">
        <ul class="ul-news-top">
          <li><a href="#">Video</a></li>
          <li><a href="#">Mới nhất</a></li>
          <li><a href="#">Xem nhiều</a></li>
        </ul>
        <ul class="ul-news-top" id="img-fun">
          <li><a href="#">Ảnh Vui</a></li>
          <li><a href="#">Mới nhất</a></li>
          <li><a href="#">Xem nhiều</a></li>
        </ul>
        <ul class="ul-news-top" id="ul-xu-huong">
          <li><a href="#">Xu Hướng</a></li>
          <li><a href="#">Mới nhất</a></li>
          <li><a href="#">Xem nhiều</a></li>
        </ul>
        <ul class="ul-news-top" id="ul-funny">
          <li><a href="#">Cười</a></li>
          <li><a href="#">Mới nhất</a></li>
          <li><a href="#">Xem nhiều</a></li>
        </ul>
      </div>
      <!--end menu-content-->
      
      <div id="news">
        <div id="featured" >
      <ul class="ui-tabs-nav">
          <?php
          if ($focus_new != null) {
          foreach ($focus_new as $r) {
            echo '
          <li class="ui-tabs-nav-item" id="nav-fragment-'. $r -> id .'">
              <a href="#fragment-'. $r -> id.'">
                  <img src="../resources/images/image1-small.jpg" width="167" height="145" />;
                  <span>'.trim_text(htmlspecialchars_decode($r -> title),10).'</span>;
              </a>
            </li>'
            ;
          }
          }
          ?>
          </ul>
      <!-- First Content -->
          <?php
          if ($focus_new != null) {
         foreach ($focus_new as $r) {
            echo '
        <div id="fragment-'. $r -> id .'" class="ui-tabs-panel ui-tabs-hide" style="">
      <img src="../resources/images/image1-small.jpg"  width="462" height="435"/>
       <div class="info" >
        <h2><a href="#" >'.trim_text(htmlspecialchars_decode($r -> title),10).'</a></h2>
        <p>'.trim_text(htmlspecialchars_decode($r -> content),10).'
                  <a href="#"  style="color:red";>Read more</a>      
                </p>
           </div>
      </div>'
        ;
          }
          }
          ?>
    </div>

         <div id="Wrapper">
          <?php
          $index=0;
          if($new_img!=null){
            foreach ($new_img as $r) {
              echo '<div class="sumary">
              <div class="image">
              <img src="../resources/images/1.jpg" width="178" height="148">
              <dd class="tittle">
              <a href="#"><p>'.$r -> title.'</p></a></dd>
              </div>
              </div>';
            }
          }
          $index++;
          ?>
 
        </div><!--end Wrapper-->
        <div id="xu-huong">
          <?php
          if($xu_huong!=null){
           foreach ($xu_huong as $r) {
            echo '

            <div class="img-xu-huong"> 
            <a href="#"> 
            <img src="../resources/images/2.jpg" />
            <p>'.$r -> title.'</p>
            </a> </div>
            ';
          }
        }
        ?>
      </div><!--end xu huong-->

      <div id="funny">
        <?php
         if($funny!=null){
        foreach ($funny as $r) {
          echo ' <div class="news-funny"> 
          <a href="#"> <i><img src="../resources/images/3.jpg" /></i>
          <h4>'.$r -> source.'</h4>
          <p>'.$r -> title.'</p>
        </a> 
         </div>
  <!--end news-funny-->
  ';   }
      }
      ?>

</div>
<!--end funny--> 

</div>
<!--end news--> 

</div>
    <!--end left-content-->