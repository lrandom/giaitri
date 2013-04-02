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
            $sql=mysql_query(" SELECT* FROM slider LIMIT 3");
            $demo=0;
            while($row_tin = @mysql_fetch_array($sql)){
             echo'
             <li class="ui-tabs-nav-item" id="nav-fragment-'.$row_tin['id'].'">
             <a href="#fragment-'.$row_tin['id'].'">
             <img src="images/'.$row_tin['hinhnho'].'" width="167" height="145" />
             <span class="feacher">20 Beautiful Long Exposure Photographs</span>
             </a>
             </li>';}
             ?>
           </ul>
           <!-- First Content -->
           <?php
           $sql=mysql_query(" SELECT* FROM slider LIMIT 3");
           $index=0;
           while($row_tin2 = @mysql_fetch_array($sql)){
             echo'
             <div id="fragment-'.$row_tin2['id'].'" class="ui-tabs-panel ui-tabs-hide" style="">
             <img src="images/'.$row_tin2['hinhlon'].'"  width="462" height="435"/>
             <div class="info" >
             <h2><a href="#" >'.$row_tin2['tieude'].'</a></h2>
             <p>'.$row_tin2['mota'].'
             <a href="#" >read more</a>
             </p>
             </div>
           </div>';}?>
         </div>
         <div id="Wrapper">
          <?php
          if($new_img!=null){
            foreach ($new_img as $r) {
              echo '<div class="sumary">
              <div class="image">
              <img src="'.$r-> thumb .'" width="178" height="148">
              <dd class="tittle">
              <a href="#"><p>'.$r -> title.'</p></a></dd>
              </div>
              </div>';
            }
          }
          ?>
 
        </div><!--end Wrapper-->
        <div id="xu-huong">
          <?php
          if($xu_huong!=null){
           foreach ($xu_huong as $r) {
            echo '

            <div class="img-xu-huong"> 
            <a href="#"> 
            <img src="'.$r -> thumb .'" />
            <p>'.$r -> title.'</p>
            </a> </div>
            ';
          }
        }
        ?>
      </div><!--end xu huong-->

      <div id="funny">
        <?php
        foreach ($funny as $r) {
          echo ' <div class="news-funny"> 
          <a href="#"> <i><img src="<?php echo $path ;?>resources/cn/funny/img-funny.png" /></i>
          <h4>Học từ đâu ra?</h4>
          <p>'.$r -> title.'</p>
        </a> 
         </div>
  <!--end news-funny-->
  '; 
      }
      ?>

</div>
<!--end funny--> 

</div>
<!--end news--> 

</div>
    <!--end left-content-->