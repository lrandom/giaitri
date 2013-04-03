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
          
          <li class="ui-tabs-nav-item" id="nav-fragment-1">
              <a href="#fragment-1">
                  <img src="<?php echo $path ;?>public/images/image1-small.jpg" width="167" height="145" />
                    <span>20 Beautiful Long Exposure Photographs</span>
              </a>
            </li>
          <li class="ui-tabs-nav-item" id="nav-fragment-2">
              <a href="#fragment-2">
                  <img src="<?php echo $path ;?>public/images/image2-small.jpg" width="167" height="145" />
                    <span>20 Beautiful Long Exposure Photographs</span>
              </a>
            </li>
          <li class="ui-tabs-nav-item" id="nav-fragment-3">
              <a href="#fragment-3">
                  <img src="<?php echo $path ;?>public/images/image3-small.jpg" width="167" height="145" />
                    <span>20 Beautiful Long Exposure Photographs</span>
              </a>
            </li>           </ul>
      <!-- First Content -->
         
            <div id="fragment-1" class="ui-tabs-panel ui-tabs-hide" style="">
      <img src="<?php echo $path ;?>public/images/image1.jpg"  width="462" height="435"/>
       <div class="info" >
        <h2><a href="#" >Cảnh sát chống bạo động khống chế kẻ dọa..</a></h2>
        <p>Sau 4 tiếng cố thủ trong vòng vây của hơn 100 cảnh sát, kẻ tưới đẫm xăng dọa tự thiêu
                    <a href="#" >read more</a>
                </p>
           </div>
      </div>
            <div id="fragment-2" class="ui-tabs-panel ui-tabs-hide" style="">
      <img src="<?php echo $path ;?>public/images/image2.jpg"  width="462" height="435"/>
       <div class="info" >
        <h2><a href="#" >Hot girl Sài Gòn nhập vai thiếu nữ H’Mông..</a></h2>
        <p>Đan Cha và Bảo Ngọc, hai ứng viên sáng giá của Miss Teen 2010, chia sẻ những trải nghiệm lý thú
                    <a href="#" >read more</a>
                </p>
           </div>
      </div>
            <div id="fragment-3" class="ui-tabs-panel ui-tabs-hide" style="">
      <img src="<?php echo $path ;?>public/images/image3.jpg"  width="462" height="435"/>
       <div class="info" >
        <h2><a href="#" >Lindsay Lohan đâm xe vào nôi em bé..</a></h2>
        <p>Có nhân chứng khẳng định, hôm 1/9, Lindsay lơ đễnh đâm vào xe nôi chở em bé do một cô trông trẻ đẩy qua đường
                    <a href="#" >read more</a>
                </p>
           </div>
      </div>  </div>

         <div id="Wrapper">
          <?php
          $index=0;
          if($new_img!=null){
            foreach ($new_img as $r) {
              echo '<div class="sumary">
              <div class="image">
              <img src="../resources/images/1.jpg" width="178" height="148">
              <dd class="tittle">
              <a href="#"><p>'.$r -> id.'</p></a></dd>
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
          <h4>'.$r -> author.'</h4>
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